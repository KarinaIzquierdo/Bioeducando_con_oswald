<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarPasswordMail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = \Illuminate\Support\Facades\Auth::user();
            $user->load('role');

            if ($user->role && $user->role->name === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            // Si no es admin, enviarlo al dashboard de usuario
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showRecoveryForm()
    {
        return view('auth.recuperar');
    }

    public function sendRecovery(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Este correo no está registrado en nuestro sistema.',
        ]);

        // 1. Generar token único (la llave)
        $token = \Illuminate\Support\Str::random(64);

        // 2. Guardar en la base de datos
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => \Illuminate\Support\Facades\Hash::make($token),
                'created_at' => now()
            ]
        );

        // 3. Enviar el correo real
        Mail::to($request->email)->send(new RecuperarPasswordMail($token, $request->email));

        return back()->with('success', '¡Perfecto! Hemos enviado un enlace de recuperación a tu correo electrónico.');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role_id' => 3, // Rol de 'usuario' por defecto
        ]);

        return redirect()->route('login')->with('success', '¡Cuenta creada con éxito! Ya puedes iniciar sesión.');
    }

    // Funciones para el paso final de recuperación
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 1. Verificar el token (simplificado para prueba)
        $user = \App\Models\User::where('email', $request->email)->first();
        
        // 2. Cambiar la contraseña
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        // 3. Limpiar el token usado
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', '¡Genial! Tu contraseña ha sido actualizada correctamente.');
    }
}

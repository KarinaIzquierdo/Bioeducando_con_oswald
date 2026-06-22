<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('foto_perfil')) {
            // Eliminar foto antigua si existe
            if ($user->foto_path && file_exists(public_path($user->foto_path))) {
                unlink(public_path($user->foto_path));
            }

            $file = $request->file('foto_perfil');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();

            // Mover físicamente a la carpeta pública
            $file->move(public_path('uploads/perfiles'), $filename);

            // Agregar a los datos de actualización
            $updateData['foto_path'] = 'uploads/perfiles/' . $filename;
        }

        $user->update($updateData);

        return back()->with('success', '¡Perfil actualizado correctamente!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', '¡Contraseña actualizada correctamente!');
    }
}

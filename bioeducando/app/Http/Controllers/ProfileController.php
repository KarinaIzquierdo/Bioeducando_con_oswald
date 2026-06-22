<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        \Illuminate\Support\Facades\Log::info('Profile update started', ['user_id' => $user->id]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'foto_perfil' => ['nullable', 'file', 'max:2048'],
        ]);

        \Illuminate\Support\Facades\Log::info('Validation passed');

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->hasFile('foto_perfil')) {
            \Illuminate\Support\Facades\Log::info('File detected', [
                'name' => $request->file('foto_perfil')->getClientOriginalName(),
                'mime' => $request->file('foto_perfil')->getMimeType(),
                'size' => $request->file('foto_perfil')->getSize(),
            ]);

            // Eliminar foto antigua si existe
            if ($user->foto_path && file_exists(public_path($user->foto_path))) {
                unlink(public_path($user->foto_path));
            }

            $file = $request->file('foto_perfil');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/perfiles');

            try {
                $file->move($destination, $filename);
                $updateData['foto_path'] = 'uploads/perfiles/' . $filename;
                \Illuminate\Support\Facades\Log::info('File moved successfully', [
                    'destination' => $destination,
                    'filename' => $filename,
                    'foto_path' => $updateData['foto_path'],
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('File move failed', ['error' => $e->getMessage()]);
                return back()->withErrors(['foto_perfil' => 'Error al guardar la imagen: ' . $e->getMessage()]);
            }
        } else {
            \Illuminate\Support\Facades\Log::info('No file detected in request', [
                'files' => $request->allFiles(),
                'hasFile' => $request->hasFile('foto_perfil'),
            ]);
        }

        // Actualizar directamente en la base de datos usando el ID
        \App\Models\User::where('id', $user->id)->update($updateData);
        \Illuminate\Support\Facades\Log::info('User updated in DB', ['updateData' => $updateData]);

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

<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController
{
    public function profile()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        return view('user.profile.index', compact('user'));
    }

    /**
     * Update data profil pengguna, termasuk jika password atau foto_profile diisi.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'sometimes|required|min:3',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'no_telepon' => 'sometimes|nullable',
            'alamat' => 'sometimes|nullable',
            'password' => 'nullable|min:6|confirmed',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->filled('name')) {
            $user->name = $validated['name'];
        }

        if ($request->filled('email')) {
            $user->email = $validated['email'];
        }

        if ($request->filled('no_telepon')) {
            $user->no_telepon = $validated['no_telepon'];
        }

        if ($request->filled('alamat')) {
            $user->alamat = $validated['alamat'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('foto_profile')) {
            if ($user->foto_profile && Storage::disk('public')->exists('profil/' . $user->foto_profile)) {
                Storage::disk('public')->delete('profil/' . $user->foto_profile);
            }

            $file = $request->file('foto_profile');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profil', $filename, 'public');

            $user->foto_profile = $filename;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}

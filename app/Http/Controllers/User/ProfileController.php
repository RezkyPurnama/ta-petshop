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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telepon' => 'required',
            'alamat' => 'required',
            'password' => 'nullable|min:6|confirmed',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data profil
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->no_telepon = $validated['no_telepon'];
        $user->alamat = $validated['alamat'];

        // Jika password diisi, hash dan simpan
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Jika foto_profile di-upload
        if ($request->hasFile('foto_profile')) {
            // Hapus foto_profile lama jika ada
            if ($user->foto_profile && Storage::disk('public')->exists('profil/' . $user->foto_profile)) {
                Storage::disk('public')->delete('profil/' . $user->foto_profile);
            }

            // Simpan foto_profile baru
            $file = $request->file('foto_profile');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profil', $filename, 'public');

            $user->foto_profile = $filename;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}

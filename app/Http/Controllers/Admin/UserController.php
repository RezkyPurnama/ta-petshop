<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use Illuminate\Http\Request;


class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data user berdasarkan id
        $user = User::findOrFail($id);

        // Kirim data ke view edit
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($id);

        $data = $request->only([
            'name',
            'email',
            'no_telepon',
            'alamat',
        ]);

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Jika ada foto diupload
        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/foto_profile'), $filename);
            $data['foto_profile'] = $filename;
        }

        $user->update($data);

        return redirect()->route('setting-user.index')->with('success', 'Data user berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

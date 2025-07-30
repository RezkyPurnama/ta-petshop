<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
    return view('auth.register');
    }
    public function proses_register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'no_telepon' => 'required|numeric|digits_between:10,15',
            'alamat' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)->letters()],


        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['email_verified_at'] = now();
        $validatedData['remember_token'] = Str::random(10);
        User::create($validatedData);
        return redirect('/login');
    }
}

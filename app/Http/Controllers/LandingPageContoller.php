<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageContoller
{
   public function admin()
    {
        return view('admin.dashboard.index');
    }
     public function user()
    {
        $user_id = Auth::id(); //
        return view('user.layouts.dashboard');
    }
}

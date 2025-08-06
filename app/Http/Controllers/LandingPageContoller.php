<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LandingPageContoller extends Controller
{
   public function admin()
    {
        return view('admin.dashboard.index');
    }
     public function user()
    {
        $produks = Produk::latest()->get(); // atau bisa pake paginate(8)
        $user_id = Auth::id(); //
        return view('user.layouts.dashboard',compact('produks'));
    }
}

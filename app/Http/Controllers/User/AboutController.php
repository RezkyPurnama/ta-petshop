<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

class AboutController
{
    public function index()
    {
        return view('user.about.index');
    }
}

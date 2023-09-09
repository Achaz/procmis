<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralUserController extends Controller
{
    public function index()
    {
        return view('users.dashboard');
    }
}

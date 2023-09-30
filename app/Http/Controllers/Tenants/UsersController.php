<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        return view('tenants.users.index', [
          'users' => User::all()
        ]);
    }
}

<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('tenants.dashboard');
    }
}

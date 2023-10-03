<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use RememberMeExpiration;


    /**
     * Display login page.
     *
     */
    public function show(): View
    {
        return view('auth.login');
    }

  /**
   * Handle account login request
   *
   * @param LoginRequest $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {

        if (!Auth::attempt($request->only('email', 'password'))) {

          return redirect()
            ->route('tenants.login.show', tenant('id'))
            ->withErrors(trans('auth.failed'));
        }

        $request->session()->regenerate();

        if($request->get('remember')) {
          $this->setRememberMeExpiration($request->user());
        }

        return redirect()->route('tenants.dashboard', tenant('id'));
    }

}

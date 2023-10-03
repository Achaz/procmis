<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Models\Invitation;

class RegisterController extends Controller
{
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
      $invitation = Invitation::where("invitation_token", $request->token)->first();
      $details = $request->only(['token', 'name', 'password', 'username']);
      $details['id'] = $request->username;
      $details['email'] = $invitation->email;

      Tenant::create($details);

      $invitation->delete();

      return redirect()
        ->route('tenants.login', $details['id'])
        ->with('success', 'Account successfully registered.');
    }

    public function requestInvitation() {
        return view('auth.request');
    }

    public function showRegistrationForm(Request $request)
    {
        return view('auth.register', [
          'invitation' => Invitation::where('invitation_token', $request->invitation_token)
            ->firstOrFail()
        ]);
    }

    /**
     * After user registered, update the invitation registered_at.
     *
     * @param $user
     */
    public function registered(Request $request, $user)
    {
        $invitation = Invitation::where('email', $user->email)->firstOrFail();
        $invitation->registered_at = $user->created_at;
        $invitation->save();
    }
}

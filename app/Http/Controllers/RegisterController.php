<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Models\Invitation;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\Hash;

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
        //$invitation = Invitation::where("invitation_token", $request->token)->first();
        $details = $request->only(['name', 'password', 'username','email']);
        // $details['id'] = $request->username;
        // $details['email'] = $request->email;
        // $details['name'] = $request->username;
        // $details['password'] = Hash::make($request->password);

        Tenant::create([
            'id'  => $details['username'],
            'name' => $details['name'],
            'email' => $details['email'],
            'username' => $details['username'],
            'password' => $details['password']
        ]);

        return view('central.accounts.approval');
    }

    public function requestInvitation() {
        return view('auth.request');
    }

    public function showRegistrationForm(Request $request)
    {
        return view('auth.register');
        // return view('auth.register', [
        //   'invitation' => Invitation::where('invitation_token', $request->invitation_token)
        //     ->firstOrFail()
        // ]);
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = Tenant::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $admin = Tenant::where('admin', 1) -> first();

        if($admin){
            $admin->notify(new NewUser($user));
        }

        return $user;
    }

}

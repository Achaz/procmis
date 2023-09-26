<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $invitations = Invitation::where('registered_at', null)->whereUser_id($request->user()->id)->orderBy('created_at', 'desc')->get();
        return view('invitations.index', compact('invitations'));
    }

    public function store(StoreInvitationRequest $request)
    {
        $invitation = new Invitation($request->all());
        if (Auth::check()) {
            $invitation->user_id = $request->user()->id;
        }
        $invitation->generateInvitationToken();
        $invitation->save();

        return redirect()->route('requestInvitation')
            ->with('success', 'Invitation to register successfully requested. Please wait for registration link.');
    }
}

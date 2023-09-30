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

    }

    public function index(Request $request)
    {
        $invitations = Invitation::whereNull('registered_at')
          ->orderBy('created_at', 'desc')
          ->get();

        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
      return view('invitations.create');
    }

    public function store(StoreInvitationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $details = $request->validated();
        $invitation = new Invitation($details);
        $invitation->invitation_token = $invitation->generateInvitationToken();
        $invitation->save();

        return redirect()->route('invitations.index')
            ->with('success', 'Invitation to register successfully requested. Please wait for registration link.');
    }
}

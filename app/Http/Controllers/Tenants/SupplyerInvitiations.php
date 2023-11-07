<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use App\Models\Tenant;
use App\Notifications\NewSupplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SupplyerInvitiations extends Controller
{
    public function create()
    {
      return view('invitations.create');
    }

    public function store(StoreInvitationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $details = $request->validated();
        $invitation = new Invitation($details);
        if (Auth::check()) {
            $invitation->user_id = $request->user()->id;
        }
        $invitation->invitation_token = $invitation->generateInvitationToken();
        $invitation->save();

        $invitation->notify(new NewSupplier($invitation));
        
        return redirect()->route('tenants.suppliers.invite',tenant('id'))
            ->with('success', 'Invitation sent to supplier successfully');
    }
}

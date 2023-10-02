<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeactivateAccount extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param Request $request
   * @param Tenant $account
   * @return Response
   */
    public function __invoke(Request $request, Tenant $account)
    {
        $account->active = false;
        $account->save();

        return back()
          ->with('Account deactivated successfully');
    }
}

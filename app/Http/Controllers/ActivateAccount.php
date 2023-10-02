<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivateAccount extends Controller
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
        $account->active = true;
        $account->save();

        return back()
          ->with('Account activated successfully');
    }
}

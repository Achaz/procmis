<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Invitation;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class AccountController extends Controller
{
    public function index(): View
    {
        return view('central.accounts.index', [
          'accounts' => Tenant::paginate(10)
        ]);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return View
   */
    public function create(): View
    {
      $roles = Role::pluck('name', 'name')->all();
      $userTypes = array_filter(array_column(UserType::cases(), 'value'), function ($value) {
        return $value !== UserType::Tenant->value;
      });

      return view('tenants.users.create', compact('roles', 'userTypes'));
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   * @throws AuthorizationException
   */
  public function store(Request $request): \Illuminate\Http\RedirectResponse
  {
    $record =  $request->validate([
      'name' => 'required|string|max:250',
      'email' => 'required|email|max:250|unique:users',
      'username' => 'required|string|max:250',
      'password' => 'required|string|min:8',
      'type' => [
        'required',
        new Enum(UserType::class)
      ]
    ]);

    $record['password'] = Hash::make($request->password);

    User::create($record);

    return redirect()->route('tenants.users.index', tenant('id'))
      ->with('success', 'Account created successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param Tenant $account
   * @return View
   */
  public function show(Tenant $account): View
  {
    return view('central.accounts.show', compact('account'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Tenant $account
   * @return View
   */
  public function edit(Tenant $account): View
  {
    return view('central.accounts.edit', compact('account'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param User $user
   * @return RedirectResponse
   * @throws AuthorizationException
   */
  public function update(Request $request, Tenant $account): RedirectResponse
  {
    $details = $request->validate([
      'name' => 'required',
      'email' => [
        'required',
        Rule::unique('tenants', 'email')->ignore($account->id)
      ],
      'username' => 'required|string|max:50'
    ]);
    $details['id'] = $details['username'];

    $account->update($details);

    return redirect()->route('central.accounts.index')
      ->with('success', 'Account updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return RedirectResponse
   * @throws AuthorizationException
   */
  public function destroy(Tenant $account): \Illuminate\Http\RedirectResponse
  {
    $this->authorize('delete user');

    $account->delete();

    return redirect()->route('tenants.users.index', tenant('id'))
      ->with('success', 'User deleted successfully');
  }
}
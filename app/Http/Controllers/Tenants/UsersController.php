<?php

namespace App\Http\Controllers\Tenants;

use App\Enums\UserType;
use App\Models\Invitation;
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

class UsersController extends Controller
{
  /**
   * @throws AuthorizationException
   */
  public function index(): View
    {
      $this->authorize('view user');
        return view('tenants.users.index', [
          'users' => User::with('roles')->paginate(10)
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
    $this->authorize('create user');

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
   * @param User $user
   * @return View
   * @throws AuthorizationException
   */
  public function show(User $user): View
  {
    $this->authorize('view user');

    return view('tenants.users.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param User $user
   * @return View
   */
  public function edit(User $user): View
  {
    $roles = Role::get(['id', 'name']);
    $userRole = $user->roles->pluck('name')->toArray();

    return view('tenants.users.edit', compact('user', 'roles', 'userRole'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param User $user
   * @return RedirectResponse
   * @throws AuthorizationException
   */
  public function update(Request $request, User $user): RedirectResponse
  {
    $this->authorize('update user', $user);

    $request->validate([
      'name' => 'required',
      'email' => [
        'required',
        Rule::unique('users', 'email')->ignore($user->id)
      ],
      'roles' => 'nullable|array'
    ]);

    $input = $request->only(['name', 'email', 'username']);

    $user->update($input);
    $user->syncRoles($request->roles);

    return redirect()->route('tenants.users.index', tenant('id'))
      ->with('success', 'User updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return RedirectResponse
   * @throws AuthorizationException
   */
  public function destroy(User $user): \Illuminate\Http\RedirectResponse
  {
    $this->authorize('delete user');

    $user->delete();

    return redirect()->route('tenants.users.index', tenant('id'))
      ->with('success', 'User deleted successfully');
  }
}

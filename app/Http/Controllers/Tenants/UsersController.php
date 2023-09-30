<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(): View
    {
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

      return view('tenants.users.create', compact('roles'));
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request): \Illuminate\Http\RedirectResponse
  {
    $record =  $request->validate([
      'name' => 'required|string|max:250',
      'email' => 'required|email|max:250|unique:users',
      'username' => 'required|string|max:250',
      'password' => 'required|string|min:8',
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
   */
  public function show(User $user): View
  {
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
   */
  public function update(Request $request, User $user): RedirectResponse
  {
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
   */
  public function destroy(User $user): \Illuminate\Http\RedirectResponse
  {
    $user->delete();

    return redirect()->route('tenants.users.index', tenant('id'))
      ->with('success', 'User deleted successfully');
  }
}

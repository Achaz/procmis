<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        return view('tenants.users.index', [
          'users' => User::paginate(10)
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

    $user = User::create($record);


    return redirect()->route('tenants.users.index', tenant('id'))
      ->with('success', 'Account created successfully.');
  }

  public function companyUser(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|string|max:250',
      'email' => 'required|email|max:250|unique:users',
      'username' => 'required|string|max:250'
    ]);

    $input = $request->all();

    $input['user_id'] = $request->user()->id;

    $user = User::create($input);

    $user->assignRole($request->input('roles'));

    return redirect()->route('company.createuser')
      ->with('success', 'Company User created successfully');
  }

  public function viewcompanyUser(Request $request)
  {
    $users = User::whereUser_id($request->user()->id)->latest()->paginate(10);

    return view('company.index', compact('users'));
  }

  public function CreateCompanyUser(Request $request)
  {
    $user_id = User::get(['id']);
    return view('company.createuser', compact('user_id'));
  }

  public function companyusersshow($id)
  {
    $user = User::find($id);
    return view('company.show', compact('user'));
  }
  public function companyuseredit($id)
  {
    $user = User::find($id);
    $roles = Role::get(['id', 'name']);
    $userRole = $user->roles->pluck('name')->toArray();

    return view('company.edit', compact('user', 'roles', 'userRole'));
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    return view('users.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::find($id);
    $roles = Role::get(['id', 'name']);
    $userRole = $user->roles->pluck('name')->toArray();

    return view('users.edit', compact('user', 'roles', 'userRole'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email,' . $id,
      'password' => 'same:confirm-password',
      'roles' => 'required'
    ]);

    $input = $request->all();

    $user = User::find($id);
    $user->update($input);
    FacadesDB::table('model_has_roles')->where('model_id', $id)->delete();

    $user->assignRole($request->input('roles'));

    return redirect()->route('users.index')
      ->with('success', 'User updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    User::find($id)->delete();
    return redirect()->route('users.index')
      ->with('success', 'User deleted successfully');
  }
}

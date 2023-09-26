<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =  $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'username' => 'required|string|max:250'
        ]);


        try {
            $user = User::create($input);
            if ($token = $request->get("token")) {
                $invitation = Invitation::where("invitation_token", $token)->first();

                $user->user_id = $invitation->user_id;

                if (is_null($invitation->user_id)) {
                    $user->assignRole("company_admin");
                }
                $user->save();
                $invitation->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }


        return redirect()->route('requestInvitation')
            ->with('success', 'Account created successfully. Please login');
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

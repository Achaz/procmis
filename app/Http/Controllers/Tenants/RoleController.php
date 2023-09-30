<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
    public function index(): View
    {
        $roles = Role::orderBy('name')->get();

        return view('tenants.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('tenants.roles.create', compact('permissions'));
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   * @throws ValidationException
   */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()
          ->route('tenants.roles.index', tenant('id'))
          ->with('success','Role created successfully');
    }

  /**
   * Display the specified resource.
   *
   * @param Role $role
   * @return View
   */
    public function show(Role $role): View
    {

        return view('tenants.roles.show', compact('role'));
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Role $role
   * @return View
   */
    public function edit(Role $role): View
    {
        $role->load('permissions');
        $permissions = Permission::all();

        return view('tenants.roles.edit', compact('role', 'permissions'));
    }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Role $role
   * @return RedirectResponse
   */
    public function update(Request $request, Role $role): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'nullable|array',
        ]);

        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('tenants.roles.index', tenant('id'))
          ->with('success','Role updated successfully');
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param Role $role
   * @return RedirectResponse
   */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('tenants.roles.index', tenant('id'))
          ->with('success','Role deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new SpatieRole);
      $roles = SpatieRole::withCount('users')->get();

    //   dd($roles);
      return view ('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', SpatieRole::class);
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:roles',
        ]);
        // get role name
        $role = SpatieRole::create(['name' => $request->name]);

        //assign permission to roles
        $role->syncPermissions($request->permissions);
       
        return back()->with('success', 'Role has been created and succesfully assigned permission');
    }

    /**
     * Display the specified resource.
     *
     * @param  Spatie\Permission\Models\Role as SpatieRole
     * @return \Illuminate\Http\Response
     */
    public function show(SpatieRole $role)
    {
        //
        $this->authorize('view', $role);
        $role->load('users', 'permissions');
        return view('admin.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(SpatieRole $role)
    {
        //
        $this->authorize('update', $role);
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRole;
use App\Http\Requests\UpdateRole;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Validation\Rule;
use Spatie\Permission\PermissionRegistrar;

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
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create role', SpatieRole::class);
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRole $request)
    {

        [
            'name' => $name,
            'permissions' => $permissions
        ] = $request->validated();
        // get role name
        $role = SpatieRole::create(['name' => $name]);

        //assign permission to roles
        $role->syncPermissions($permissions);

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
        //Check if user is authroized to update this model
        $this->authorize('update', $role);
        $role->load('permissions');
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRole $request, SpatieRole $role)
    {
        //
        [
            'name' => $name,
            'permissions' => $permissions
        ] = $request->validated();


        $role->name = $name;
        $role->save();

        //assign permission to roles
        $role->syncPermissions($permissions);

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        return redirect()->route('admin.role.show', $role->id)->with('success', 'Role has been succesfully updated and assigned permissions');
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
    /**
     * shows the form for adding users to role
     *
    
     */
    public function assignForm(SpatieRole $role)
    {
        $this->authorize('assign', $role);
        $role->load('users');


        // Get all users that are admin
        $users = User::select('id', 'name', 'email')->where('admin', true)->get();

        //Get the users that does not have the role
        $users = $users->diff($role->users);
        return view('admin.role.assign', compact('role', 'users'));
    }

    /**
     * adds supplied users to resource
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToRole(Request $request, SpatieRole $role)
    {
        $this->authorize('assign', $role);
        $this->validate($request, [
            'users' => 'required|array',
        ]);
        $users = $request->users;
        foreach ($users as  $userId) {
            $user = User::findOrFail($userId);
            $user->assignRole($role->pluck('name'));
        }
        return back()->with('success', 'User\'s Assigned Successfully');
    }

    /**
     * removes supplied users from role
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromRole(Request $request, SpatieRole $role)
    {
        $this->validate($request, [
            'members' => 'required|array',
        ]);
        $users = $request->members;
        foreach ($users as  $userId) {
            $user = User::findOrFail($userId);
            $user->removeRole($role);
        }
        return back()->with('success', 'User\'s Has Been Successfully Removed From Role');
    }
}

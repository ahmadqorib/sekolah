<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function role()
    {
        $roles = Role::withCount(['permissions','users'])->get();
       
        return view('admin.permission.role', compact('roles'));
    }

    public function createRole()
    {
        $permissions = Permission::latest()->get();

        return view('admin.permission.manage-role', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            notice('error', 'Data gagal divalidasi');
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $role = Role::create(['name' => $request->name]);

            if($role)
                $role->givePermissionTo($request['permissions']);

            notice('success', 'Data berhasil disimpan');
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.role.index');
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::latest()->get();

        return view('admin.permission.manage-role', compact('role', 'permissions'));
    }

    public function updateRole($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            notice('error', 'Data gagal divalidasi');
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $role = Role::findOrFail($id);
            $role->update(['name'=>$request->name]);

            if($role)
                $role->permissions()->sync($request['permissions']);

            notice('success', 'Data berhasil diperbaharui');
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.role.index');
    }

    public function deleteRole($id)
    {
        try {
            $role = Role::destroy($id);

            notice('success', 'Data berhasil dihapus');
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.role.index');
    }

    public function permission()
    {
        $permissions = Permission::latest()->paginate(10);
       
        return view('admin.permission.permission', compact('permissions'));
    }
}

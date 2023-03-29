<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Models\LogEventMod;


class RoleController extends Controller
{
    public function create()
    {
        $array_permission = Permission::select('id', 'name', 'description', 'visible_name')->get();
        return view('MainApp.rols.create', compact('array_permission'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del rol no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $array_permission = $request->permission;

        //create new role
        $obj_role = Role::create(['name' => $request->name, 'description' => $request->description]);


        //native funcion of the package to upate permissions
        $obj_role->syncPermissions($array_permission);

        return redirect()->route('role.index');
    }

    public function edit($role_id)
    {

        $obj_role = Role::where('id', $role_id)->select('id', 'name', 'description')->first();
        $array_permission = Permission::select('id', 'name', 'description', 'visible_name')->get();
        $array_permission_id = Role::where('id', $role_id)->first()->permissions->pluck('id')->toArray();

        return view('MainApp.rols.edit', compact('obj_role', 'array_permission_id', 'array_permission'));
    }

    public function update($role_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $role_id
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del rol no es correcta, error al modificar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Role::where('id', $role_id)->update(['name' => $request->name, 'description' => $request->description]);

        $obj_role = Role::where('id', $role_id)->first();

        //native funcion of the package to upate permissions
        $obj_role->syncPermissions($request->permission);

        return redirect()->route('role.index');
    }
}

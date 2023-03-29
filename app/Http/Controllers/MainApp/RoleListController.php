<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleListController extends Controller
{
    public function index()
    {

        $array_role = Role::select('id', 'description', 'name', 'created_at')->get();

        return view('MainApp.rols.list', compact('array_role'));
    }

    public function delete(Request $request)
    {
        $obj_role = Role::where('id', $request->role_id)->first();
        if (isset($obj_role))
        {
            $obj_role->syncPermissions([]);
            //delete all the permissions of the role
            $obj_role->delete();
            return 'success';
        }
        else
        {
            return 'error';
        }
    }

    public function checkRoleHasUser($role_id)
    {
        if ($role_id)
        {
            $array_role_has_users = DB::table('model_has_roles')->where('role_id', $role_id)->select('role_id')->get();
            if (count($array_role_has_users) > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}

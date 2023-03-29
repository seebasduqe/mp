<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LogEventMod;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\MainApp\SubCompany;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //Return user create view
    public function create()
    {
        $array_role = Role::pluck('name', 'id');
        $array_role->prepend('Selecciona un rol', '');

        //Get the subcompanies list
        $array_subcompany = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_subcompany->prepend('Selecciona una Subempresa', '');

        return view('MainApp.users.create', compact('array_subcompany', 'array_role'));
    }

    //Return user edit view
    public function edit($user_id)
    {
        $array_role = Role::pluck('name', 'id');
        $array_role->prepend('Selecciona un rol', '');

        //Get the subcompanies list
        $array_subcompany = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_subcompany->prepend('Selecciona una Subempresa', '');

        //Get the obj of the user
        $obj_user = User::where('id', $user_id)->select('id', 'name', 'username', 'email', 'sub_company_id')->first();

        if ($obj_user->roles->first())
        {
            $obj_user['role_id'] = $obj_user->roles->first()->id;
        }
        else
        {
            $obj_user['role_id'] = 0;
        }

        return view('MainApp.users.edit', compact('obj_user', 'array_subcompany', 'array_role'));
    }

    //Get the user post info from the form and store in bdd
    public function store(Request $request)
    {

        //Validate the user post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users,username,NULL,id,status,1',
            'name' => 'required',
            'password' => 'required',
            'email' => 'nullable|unique:users,email,NULL,id,status,1',
            'sub_company_id' => 'required',
            'role_id' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del usuario no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //Store the user in bdd with the post info
        $obj_user = User::create([
            'sub_company_id' => $request->sub_company_id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1
        ]);

        $role = Role::find($request->role_id);
        $obj_user->roles()->attach($role);

        return redirect()->route('users.index');
    }

    //Get the user post info from the form and update in bdd
    public function update($user_id, Request $request)
    {

        //Validate the user post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users,username,' . $user_id . ',id,status, 1',

            'name' => 'required',
            'email' => 'nullable|unique:users,email,' . $user_id . ',id,status, 1',
            'sub_company_id' => 'required',
            'role_id' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del usuario no es correcta, error al modificar', 0);

            return redirect('/usuarios/modificar/' . $user_id)
                ->withErrors($validator)
                ->withInput();
        }

        //Update the user info with the post info to update the user data
        User::find($user_id)->update(
            [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'sub_company_id' => $request->sub_company_id
            ]
        );

        //update password if exist
        if (isset($request->password) && $request->password != '')
        {
            User::find($user_id)->update(
                [
                    'password' => Hash::make($request->password),
                ]
            );
        }

        //assign role to user
        $obj_user = User::find($user_id);

        //delete the relationship bettwen user and roles
        DB::table('model_has_roles')->where('model_id', $user_id)->delete();
        $role = Role::find($request->role_id);
        $obj_user->roles()->attach($role);

        return redirect()->route('users.index');
    }
}

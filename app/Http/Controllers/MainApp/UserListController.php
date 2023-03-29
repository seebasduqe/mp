<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserListController extends Controller
{
    //Return user list view, return the user list
    public function index()
    {
        //Get the array of users with status 1
        $array_user = User::where('status', 1)->select('id', 'name', 'username', 'email', 'status', 'created_at')->orderBy('id', 'desc')->get();

        return view('MainApp.users.list', compact('array_user'));
    }

    //Get the user id and update the status to 0 to desactivate the user
    public function delete(Request $request)
    {

        $user_id = $request->user_id;
        if ($user_id > 0)
        {
            User::where('id', $user_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

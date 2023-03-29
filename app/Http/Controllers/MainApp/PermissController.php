<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use ErrorException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissController extends Controller
{
    public function store ()
    {
        try {
            Permission::create([
                // 'name' => 'gray_bar',
                // 'guard_name' => 'web',
                // 'visible_name' => 'Barra gris'
            ]);
            $array_permission = Permission::select('id', 'name', 'description', 'visible_name')->get();
            dd($array_permission);
        } catch (ErrorException $exception) {
            dd($exception);
        }
    }
}

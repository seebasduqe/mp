<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\LogEventMod;
use App\Models\MainApp\Province;

class ProvinceController extends Controller
{
    //Return create province view
    public function create()
    {
        return view('MainApp.provinces.create');
    }

    public function store(Request $request)
    {
        //Validate the province post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'province_name' => 'required',
            'phone_prefix' => 'numeric|required',
            'code_prefix' => 'nullable|size:2'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la provincia no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //Store the province in bdd with the post info
        Province::create([
            'province_name' => $request->province_name,
            'phone_prefix' => $request->phone_prefix,
            'code_prefix' => $request->code_prefix
        ]);

        return redirect()->route('provinces.index');
    }

    //Return edit province view
    public function edit($province_id)
    {
        //get the obj province with the province_id passed from param
        $obj_province = Province::from('provinces as p')
            ->where('p.province_id', $province_id)
            ->select('p.province_id', 'p.province_name', 'p.phone_prefix', 'p.code_prefix')
            ->first();

        //reutrn view with the province obj
        return view('MainApp.provinces.edit', compact('obj_province'));
    }

    public function update($province_id, Request $request)
    {
        //Validate the province post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'province_name' => 'required',
            'phone_prefix' => 'numeric|required',
            'code_prefix' => 'nullable|size:2'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la provincia no es correcta, error al modificar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //Update the province in bdd with the post info
        Province::where('province_id', $province_id)->update([
            'province_name' => $request->province_name,
            'phone_prefix' => $request->phone_prefix,
            'code_prefix' => $request->code_prefix
        ]);

        return redirect()->route('provinces.index');
    }
}

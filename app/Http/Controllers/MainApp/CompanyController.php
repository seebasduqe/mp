<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MainApp\Company;
use App\Models\LogEventMod;

class CompanyController extends Controller
{
    //Return create company view
    public function create()
    {

        return view('MainApp.companies.create');
    }

    //Return edit company view
    public function edit($company_id)
    {
        //get the obj company with the company_id pased from param
        $obj_company = Company::where('company_id', $company_id)->select('company_id', 'name', 'cif', 'address', 'postal_code', 'population', 'start_date')->first();

        //reutrn view with the company obj
        return view('MainApp.companies.edit', compact('obj_company'));
    }

    public function store(Request $request)
    {
        //Validate the company post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'postal_code' => 'max:6',
            'start_date' => 'required',
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la empresa no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //Store the company in bdd with the post info
        Company::create([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'cif' => $request->cif,
            'address' => $request->address,
            'population' => $request->population,
            'status' => 1,
            'start_date' => $request->start_date
        ]);

        return redirect()->route('companies.index');
    }

    public function update($company_id, Request $request)
    {
        //Validate the company post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'postal_code' => 'max:6',
            'start_date' => 'required',
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la empresa no es correcta, error al modificar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //Update the company in bdd with the post info
        Company::find($company_id)->update([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'cif' => $request->cif,
            'address' => $request->address,
            'population' => $request->population,
            'status' => 1,
            'start_date' => $request->start_date
        ]);

        return redirect()->route('companies.index');
    }
}

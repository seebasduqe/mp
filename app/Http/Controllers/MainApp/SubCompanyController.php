<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MainApp\SubCompany;
use App\Models\MainApp\Company;
use App\Models\LogEventMod;

class SubCompanyController extends Controller
{
    //Return create sub-company view
    public function create()
    {
        //Get the  companies list
        $array_company = Company::where('status', 1)->pluck('name', 'company_id');
        $array_company->prepend('Selecciona una Subempresa', '');
        return view('MainApp.sub_companies.create', compact('array_company'));
    }

    //Return edit sub-company view
    public function edit($sub_company_id)
    {
        //get the obj company with the sub-company_id pased from param
        $obj_sub_company = SubCompany::where('sub_company_id', $sub_company_id)->select('sub_company_id', 'company_id', 'name', 'cif', 'address', 'postal_code', 'population', 'start_date')->first();

        //Get the  companies list
        $array_company = Company::where('status', 1)->pluck('name', 'company_id');
        $array_company->prepend('Selecciona una Empresa', '');

        //reutrn view with the sub-company obj
        return view('MainApp.sub_companies.edit', compact('obj_sub_company', 'array_company'));
    }

    public function store(Request $request)
    {
        //Validate the sub-company post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_id' => 'required',
            'start_date' => 'required',
            'postal_code' => 'max:6'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la sub-empresa no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //Store the sub-company in bdd with the post info
        SubCompany::create([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'cif' => $request->cif,
            'address' => $request->address,
            'population' => $request->population,
            'company_id' => $request->company_id,
            'start_date' => $request->start_date,
            'active' => 1,
            'status' => 1
        ]);

        return redirect()->route('sub_companies.index');
    }

    public function update($sub_company_id, Request $request)
    {

        //Validate the sub-company post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_id' => 'required',
            'start_date' => 'required',
            'postal_code' => 'max:6'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la sub-empresa no es correcta, error al modificar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $obj_sub_company = SubCompany::find($sub_company_id);
        //check if exist the sub-company
        if (isset($obj_sub_company))
        {
            //Update the sub-company in bdd with the post info
            $obj_sub_company->update([
                'name' => $request->name,
                'postal_code' => $request->postal_code,
                'cif' => $request->cif,
                'address' => $request->address,
                'population' => $request->population,
                'company_id' => $request->company_id,
                'start_date' => $request->start_date

            ]);
        }
        else
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'No es posible modificar la sub-empresa, al parecer el id es incorrecto', 0);
        }

        return redirect()->route('sub_companies.index');
    }
}

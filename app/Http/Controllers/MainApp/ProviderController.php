<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\LogEventMod;
use App\Models\MainApp\Provider;
use App\Models\MainApp\ProviderAddress;
use App\Models\MainApp\SubCompany;

class ProviderController extends Controller
{
    //Return create provider view
    public function create()
    {
        // use db to access to a table without a model
        $array_country = DB::table('countries')->pluck('name', 'country_id');
        $array_country->prepend('Selecciona un Pais', '');

        $array_province = DB::table('provinces')->pluck('province_name', 'province_id');
        $array_province->prepend('Selecciona una Provincia', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'company_id');
        $array_sub_company->prepend('Selecciona una Subempresa', '');

        return view('MainApp.providers.create', compact('array_country', 'array_province', 'array_sub_company'));
    }

    //Return edit provider view
    public function edit($provider_id)
    {
        //get the obj provider with the provider_id pased from param
        $obj_provider = Provider::from('providers as p')
            ->where('p.provider_id', $provider_id)
            ->leftJoin('providers_address as pa', 'pa.provider_address_id', '=', 'p.provider_address_id')
            ->select('p.provider_id', 'p.sub_company_id', 'p.email', 'p.telephone', 'p.fax', 'p.nif', 'p.nif_ue', 'p.short_name', 'p.name as provider_name', 'pa.address', 'pa.postal_code', 'pa.province_id', 'pa.country_id', 'pa.town')
            ->first();

        // use db to access to a table without a model
        $array_country = DB::table('countries')->pluck('name', 'country_id');
        $array_country->prepend('Selecciona un Pais', '');

        $array_province = DB::table('provinces')->pluck('province_name', 'province_id');
        $array_province->prepend('Selecciona una Provincia', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona una Subempresa', '');

        //reutrn view with the Provider obj
        return view('MainApp.providers.edit', compact('obj_provider', 'array_country', 'array_province', 'array_sub_company'));
    }

    public function store(Request $request)
    {
        //Validate the provider post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'provider_name' => 'required',
            'nif' => 'required|unique:providers,nif,NULL,provider_id,status,1',
            'sub_company_id' => 'numeric|required',
            'address' => 'required',
            'town' => 'required',
            'postal_code' => 'max:6',
            'province_id' => 'numeric|required',
            'country_id' => 'numeric|required',
            'email' => 'required',
            'telephone' => 'required'
        ]);

        // 'nif' => 'required|unique:providers,nif,NULL,provider_id,status,1',

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del proveedor no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $provider_address = ProviderAddress::create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'town' => $request->town,
            'province_id' => $request->province_id,
            'country_id' => $request->country_id
        ]);

        //Store the client in bdd with the post info
        Provider::create([
            'provider_address_id' => $provider_address->provider_address_id,
            'sub_company_id' => $request->sub_company_id,
            'nif' => $request->nif,
            'nif_ue' => $request->nif_ue,
            'name' => $request->provider_name,
            'short_name' => $request->short_name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'fax' => $request->fax
        ]);

        return redirect()->route('provider.index');
    }

    public function update($provider_id, Request $request)
    {
        //Validate the client post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'provider_name' => 'required',
            'nif' => 'required|unique:providers,nif,' . $provider_id . ',provider_id,status,1',
            'sub_company_id' => 'numeric|required',
            'address' => 'required',
            'town' => 'required',
            'postal_code' => 'max:6',
            'province_id' => 'numeric|required',
            'country_id' => 'numeric|required',
            'email' => 'required',
            'telephone' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del proveedor no es correcta, error al modificar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        //Update the provider in bdd with the post info
        Provider::where('provider_id', $provider_id)->update([
            'sub_company_id' => $request->sub_company_id,
            'nif' => $request->nif,
            'nif_ue' => $request->nif_ue,
            'name' => $request->provider_name,
            'short_name' => $request->short_name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'fax' => $request->fax
        ]);

        //get the provider address id
        $provider_address = Provider::where('provider_id', $provider_id)->select('provider_id', 'provider_address_id')->first();

        //Update the provider address in bdd with the post info
        ProviderAddress::where('provider_address_id', $provider_address->provider_address_id)->update([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'town' => $request->town,
            'province_id' => $request->province_id,
            'country_id' => $request->country_id
        ]);



        return redirect()->route('provider.index');
    }
}

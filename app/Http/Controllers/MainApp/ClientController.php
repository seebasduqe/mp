<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\LogEventMod;
use App\Models\MainApp\Client;
use App\Models\MainApp\ClientAddress;
use App\Models\MainApp\SubCompany;

class ClientController extends Controller
{
    //Return create client view
    public function create()
    {
        // use db to access to a table without a model
        $array_country = DB::table('countries')->pluck('name', 'country_id');
        $array_country->prepend('Selecciona un Pais', '');

        $array_province = DB::table('provinces')->pluck('province_name', 'province_id');
        $array_province->prepend('Selecciona una Provincia', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'company_id');
        $array_sub_company->prepend('Selecciona una Subempresa', '');

        return view('MainApp.clients.create', compact('array_country', 'array_province', 'array_sub_company'));
    }

    //Return edit client view
    public function edit($client_id)
    {
        //get the obj client with the client_id pased from param
        $obj_client = Client::from('clients as c')
            ->where('c.client_id', $client_id)
            ->leftJoin('clients_address as ca', 'ca.client_address_id', '=', 'c.client_address_id')
            ->select('c.client_id', 'c.sub_company_id', 'c.nif', 'c.nif_ue', 'c.short_name', 'c.name as client_name', 'ca.address', 'ca.postal_code', 'ca.province_id', 'ca.country_id', 'ca.town')
            ->first();


        // use db to access to a table without a model
        $array_country = DB::table('countries')->pluck('name', 'country_id');
        $array_country->prepend('Selecciona un Pais', '');

        $array_province = DB::table('provinces')->pluck('province_name', 'province_id');
        $array_province->prepend('Selecciona una Provincia', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona una Subempresa', '');

        //reutrn view with the client obj
        return view('MainApp.clients.edit', compact('obj_client', 'array_country', 'array_province', 'array_sub_company'));
    }

    public function store(Request $request)
    {
        //Validate the client post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'client_name' => 'required',
            'address' => 'required',
            'postal_code' => 'max:6',
            'sub_company_id' => 'numeric|required',
            'nif' => 'required',
            'province_id' => 'numeric|required',
            'country_id' => 'numeric|required',
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del cliente no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $client_address = ClientAddress::create([
            'province_id' => $request->province_id,
            'country_id' => $request->country_id,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'town' => $request->town

        ]);

        //Store the client in bdd with the post info
        Client::create([
            'client_address_id' => $client_address->client_address_id,
            'sub_company_id' => $request->sub_company_id,
            'nif' => $request->nif,
            'nif_ue' => $request->nif_ue,
            'short_name' => $request->short_name,
            'name' => $request->client_name
        ]);

        return redirect()->route('clients.index');
    }

    public function update($client_id, Request $request)
    {
        //Validate the client post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'client_name' => 'required',
            'address' => 'required',
            'postal_code' => 'max:6',
            'sub_company_id' => 'numeric|required',
            'nif' => 'required',
            'province_id' => 'numeric|required',
            'country_id' => 'numeric|required',
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del cliente no es correcta, error al modificar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //Update the client in bdd with the post info
        Client::where('client_id', $client_id)->update([
            'sub_company_id' => $request->sub_company_id,
            'nif' => $request->nif,
            'nif_ue' => $request->nif_ue,
            'short_name' => $request->short_name,
            'name' => $request->client_name
        ]);

        //get the client address id
        $client_address = Client::where('client_id', $client_id)->select('client_id', 'client_address_id')->first();

        //Update the client address in bdd with the post info
        ClientAddress::where('client_address_id', $client_address->client_address_id)->update([
            'province_id' => $request->province_id,
            'country_id' => $request->country_id,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'town' => $request->town
        ]);

        return redirect()->route('clients.index');
    }
}

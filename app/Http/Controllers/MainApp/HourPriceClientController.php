<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogEventMod;
use App\Models\MainApp\HourPriceClient;
use App\Models\MainApp\HourType;
use App\Models\MainApp\Client;
use App\Models\MainApp\SubCompany;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HourPriceClientController extends Controller
{

    public function create()
    {
        // use db to access to a table without a model
        $array_job = DB::table('jobs')->pluck('description', 'job_id');
        $array_job->prepend('Selecciona un tipo de trabajo', '');

        $array_hour_type = HourType::pluck('name', 'hour_type_id');
        $array_hour_type->prepend('Selecciona un tipo de hora', '');

        $array_client = Client::where('status', 1)->pluck('name', 'client_id');
        $array_client->prepend('Selecciona un cliente', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona una sub empresa', '');

        return view('MainApp.hours_price_client.create', compact('array_job', 'array_hour_type', 'array_client', 'array_sub_company'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hour_type_id' => 'numeric|required',
            'job_id' => 'numeric|required',
            'client_id' => 'numeric|required',
            'sub_company_id' => 'numeric|required',
            'pvp' => 'numeric|required',
            'cost' => 'numeric|nullable',

        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del cliente no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        //Store the hour price in bdd with the post info
        HourPriceClient::create([
            'hour_type_id' => $request->hour_type_id,
            'job_id' => $request->job_id,
            'client_id' => $request->client_id,
            'sub_company_id' => $request->sub_company_id,
            'pvp' => $request->pvp,
            'cost' => $request->cost
        ]);

        return redirect()->route('hour_price_client.index');
    }

    public function edit($hour_price_id)
    {

        $obj_hour_price = HourPriceClient::from('hours_price as hp')
            ->where('hp.hour_price_id', $hour_price_id)
            ->select('hp.hour_price_id', 'hp.cost', 'hp.pvp', 'hp.client_id', 'hp.hour_type_id', 'hp.job_id', 'hp.sub_company_id')
            ->first();

        // use db to access to a table without a model
        $array_job = DB::table('jobs')->pluck('description', 'job_id');
        $array_job->prepend('Selecciona un tipo de trabajo', '');

        $array_hour_type = HourType::pluck('name', 'hour_type_id');
        $array_hour_type->prepend('Selecciona un tipo de hora', '');

        $array_client = Client::where('status', 1)->pluck('name', 'client_id');
        $array_client->prepend('Selecciona un cliente', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona una sub empresa', '');

        return view('MainApp.hours_price_client.edit', compact('array_job', 'array_hour_type', 'array_client', 'array_sub_company', 'obj_hour_price'));
    }

    public function update($hour_price_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hour_type_id' => 'numeric|required',
            'job_id' => 'numeric|required',
            'client_id' => 'numeric|required',
            'sub_company_id' => 'numeric|required',
            'pvp' => 'numeric|required',
            'cost' => 'numeric|nullable',

        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del cliente no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        HourPriceClient::where('hour_price_id', $hour_price_id)->update([
            'hour_type_id' => $request->hour_type_id,
            'job_id' => $request->job_id,
            'client_id' => $request->client_id,
            'sub_company_id' => $request->sub_company_id,
            'pvp' => $request->pvp,
            'cost' => $request->cost
        ]);

        return redirect()->route('hour_price_client.index');
    }
}

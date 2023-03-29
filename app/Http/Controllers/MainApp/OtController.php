<?php

namespace App\Http\Controllers\MainApp;

use Carbon\Carbon;
use App\Models\MainApp\Ot;
use App\Models\LogEventMod;
use Illuminate\Http\Request;
use App\Models\MainApp\Client;
use App\Models\MainApp\Person;
use App\Models\MainApp\SubCompany;
use Illuminate\Support\Facades\DB;
use App\Models\MainApp\DestinyType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OtController extends Controller
{

    public function create()
    {
        $array_person = Person::select(
            DB::raw("CONCAT(name,' ',surnames) AS name"),
            'person_id'
        )->where('status', 1)->pluck('name', 'person_id');

        $array_person->prepend('Selecciona un técnico', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona un sub-empresa', '');

        $array_client = Client::where('status', 1)->pluck('name', 'client_id');
        $array_client->prepend('Selecciona un cliente', '');

        $array_destiny_type = DestinyType::pluck('name', 'destiny_type_id');
        $array_destiny_type->prepend('Selecciona un tipo de destino', '');

        $array_ot = Ot::where('status', 1)->pluck('ot_number', 'ot_id');
        $array_ot->prepend('Selecciona una ot', '');

        $array_type_ot = array(
            '' => 'Selecciona un tipo de ot',
            1 => 'Administración',
            2 => 'General',
            3 => 'Servicio'
        );

        return view('MainApp.ot.create_common_data', compact('array_person', 'array_type_ot', 'array_ot', 'array_sub_company', 'array_client', 'array_destiny_type'));
    }

    public function edit($ot_id)
    {
        if (!$ot_id)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de la ot el id de la ot ha venido nullo por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $obj_ot = Ot::from('ot as o')
            ->select('o.ot_id', 'o.person_id', 'o.client_id', 'o.ot_related_id', 'o.ot_number', 'o.ot_number_info', 'o.description', 'o.destiny_type_id', 'o.type', 'o.sub_company_id')
            ->where('o.ot_id', $ot_id)
            ->first();

        if (!$obj_ot && $obj_ot == '')
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de la ot el id de la ot ha venido incorrecto por get, id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $array_person = Person::select(
            DB::raw("CONCAT(name,' ',surnames) AS name"),
            'person_id'
        )->where('status', 1)->pluck('name', 'person_id');

        $array_person->prepend('Selecciona un técnico', '');

        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona un sub-empresa', '');

        $array_client = Client::where('status', 1)->pluck('name', 'client_id');
        $array_client->prepend('Selecciona un cliente', '');

        $array_destiny_type = DestinyType::pluck('name', 'destiny_type_id');
        $array_destiny_type->prepend('Selecciona un tipo de destino', '');

        $array_ot = Ot::where([['status', 1], ['ot_id', '!=', $ot_id]])->pluck('ot_number', 'ot_id');
        $array_ot->prepend('Selecciona una ot', '');

        $array_type_ot = array(
            '' => 'Selecciona un tipo de ot',
            1 => 'Administración',
            2 => 'General',
            3 => 'Servicio'
        );


        return view('MainApp.ot.edit_common_data', compact('obj_ot', 'array_person', 'array_type_ot', 'array_ot', 'array_sub_company', 'array_client', 'array_destiny_type'));
    }

    /**
     * Todo - Realizar el update de la ot
     */
    public function update(Request $request, $ot_id)
    {

        $validator = Validator::make($request->all(), [
            'ot_number_info' => 'required',
            'ot_number' => 'required',
            'person_id' => 'required',
            'type' => 'required',
            'sub_company_id' => 'required',
            'client_id' => 'required',
            'destiny_type_id' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la ot no es correcta, error al editar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Ot::where('ot_id', $ot_id)->update([
            'ot_number_info' => $request->ot_number_info,
            'ot_number' => $request->ot_number,
            'person_id' => $request->person_id,
            'type' => $request->type,
            'sub_company_id' => $request->sub_company_id,
            'client_id' => $request->client_id,
            'destiny_type_id' => $request->destiny_type_id,
            'description' => $request->description,
            'ot_related_id' => $request->ot_related_id
        ]);

        return redirect()->route('ot.edit_common_data', $ot_id)->with('success_msg', 'Se han actualizado los datos de la ot correctamente');
    }

    /**
     * Todo - Realizar el store de la ot
     */
    public function store(Request $request)
    {
        //generar nueva ot
        $validator = Validator::make($request->all(), [
            'ot_number_info' => 'required',
            'ot_number' => 'required',
            'person_id' => 'required',
            'type' => 'required',
            'sub_company_id' => 'required',
            'client_id' => 'required',
            'destiny_type_id' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la ot no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $ot = Ot::create([
            'ot_number_info' => $request->ot_number_info,
            'ot_number' => $request->ot_number,
            'person_id' => $request->person_id,
            'type' => $request->type,
            'sub_company_id' => $request->sub_company_id,
            'client_id' => $request->client_id,
            'destiny_type_id' => $request->destiny_type_id,
            'description' => $request->description,
            'creation_date' => Carbon::now()->format('Y-m-d'),
            'ot_related_id' => $request->ot_related_id
        ]);

        return redirect()->route('ot.create_articles', $ot->ot_id);
    }
}

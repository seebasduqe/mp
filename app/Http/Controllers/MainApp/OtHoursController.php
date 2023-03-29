<?php

namespace App\Http\Controllers\MainApp;

use App\Models\MainApp\Ot;
use App\Models\LogEventMod;
use Illuminate\Http\Request;
use App\Models\MainApp\HourOt;
use App\Models\MainApp\Person;
use App\Models\MainApp\Category;
use App\Models\MainApp\HourType;
use App\Models\MainApp\PersonCost;
use App\Models\MainApp\SubCompany;
use Illuminate\Support\Facades\DB;
use App\Models\MainApp\DestinyType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OtHoursController extends Controller
{

    public function create($ot_id)
    {

        $type = 'create';

        if (!$ot_id)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la creación de horas de la ot el id de la ot ha venido nullo por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }
        $array_subompany = SubCompany::pluck('name', 'sub_company_id');
        $array_subompany->prepend('Selecciona una subempresa', '');

        $array_category = Category::pluck('description', 'category_id');
        $array_category->prepend('Selecciona un tipo de trabajo', '');

        $array_destiny_type = DestinyType::pluck('name', 'destiny_type_id');
        $array_destiny_type->prepend('Selecciona un tipo de destino', '');

        $array_hour_type = HourType::pluck('name', 'hour_type_id');
        $array_hour_type->prepend('Selecciona un tipo de hora', '');

        $array_person = Person::select(
            DB::raw("CONCAT(name,' ',surnames) AS name"),
            'person_id'
        )->where('status', 1)->pluck('name', 'person_id');
        $array_person->prepend('Selecciona una persona', '');



        $obj_ot = Ot::from('ot as o')
            ->select('o.ot_id')
            ->where([['ot_id', $ot_id], ['status', '!=', 0]])
            ->first();

        if (!$obj_ot && $obj_ot == '')
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la creación de horas de la ot el id de la ot ha venido incorrecto por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $obj_hour_ot = new HourOt();
        $array_hour = $obj_hour_ot->getHoursOt($ot_id);

        $array_resume = $obj_hour_ot->calculateResumeOtHour($array_hour);

        return view('MainApp.ot.create_hours', compact('obj_ot', 'type', 'array_hour', 'array_subompany', 'array_category', 'array_destiny_type', 'array_hour_type', 'array_person', 'array_resume'));
    }

    public function edit($ot_id)
    {
        $type = 'edit';

        if (!$ot_id)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de horas de la ot el id de la ot ha venido nullo por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $array_subompany = SubCompany::pluck('name', 'sub_company_id');
        $array_subompany->prepend('Selecciona una subempresa', '');

        $array_category = Category::pluck('description', 'category_id');
        $array_category->prepend('Selecciona un tipo de trabajo', '');

        $array_destiny_type = DestinyType::pluck('name', 'destiny_type_id');
        $array_destiny_type->prepend('Selecciona un tipo de destino', '');

        $array_hour_type = HourType::pluck('name', 'hour_type_id');
        $array_hour_type->prepend('Selecciona un tipo de hora', '');

        $array_person = Person::select(
            DB::raw("CONCAT(name,' ',surnames) AS name"),
            'person_id'
        )->where('status', 1)->pluck('name', 'person_id');
        $array_person->prepend('Selecciona una persona', '');

        $obj_ot = Ot::from('ot as o')
            ->select('o.ot_id')
            ->where([['ot_id', $ot_id], ['status', '!=', 0]])
            ->first();

        if (!$obj_ot && $obj_ot == '')
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de horas de la ot el id de la ot ha venido incorrecto por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }
        $obj_hour_ot = new HourOt();
        $array_hour = $obj_hour_ot->getHoursOt($ot_id);

        $array_resume = $obj_hour_ot->calculateResumeOtHour($array_hour);


        return view('MainApp.ot.edit_hours', compact('obj_ot', 'type', 'array_hour', 'array_subompany', 'array_category', 'array_destiny_type', 'array_hour_type', 'array_person', 'array_resume'));
    }

    public function store(Request $request, $ot_id)
    {

        $validator = Validator::make($request->all(), [
            'sub_company_id' => 'required|numeric',
            'person_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'destiny_type_id' => 'required|numeric',
            'hours' => 'required|numeric',
            'hour_type_id' => 'required|numeric',
            'date' => 'required',
            'price' => 'required|numeric'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del articulo de la ot no es correcta, error al editar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        HourOt::create([
            'sub_company_id' => $request->sub_company_id,
            'person_id' => $request->person_id,
            'category_id' => $request->category_id,
            'destiny_type_id' => $request->destiny_type_id,
            'hours' => $request->hours,
            'hour_type_id' => $request->hour_type_id,
            'date' => $request->date,
            'price' => $request->price,
            'ot_id' => $ot_id

        ]);



        if ($request->type == 'edit')
        {
            return redirect()->route('ot.edit_hours', $ot_id)->with('success_msg', 'Se han añadido las horas correctamente');
        }
        else
        {
            return redirect()->route('ot.create_hours', $ot_id)->with('success_msg', 'Se han añadido las horas correctamente');
        }
    }

    public function getPersonHourPrice(Request $request)
    {
        if ($request->person_id == '' || $request->hour_type_id == '')
        {
            return 0;
        }
        $person_cost_obj = PersonCost::select('cost')->where([['person_id', $request->person_id], ['hour_type_id', $request->hour_type_id]])->first();

        if ($person_cost_obj)
        {
            return $person_cost_obj->cost;
        }
        else
        {
            return 0;
        }
    }

    public function storeBulkLoadHours(Request $request, $ot_id)
    {

        $validator = Validator::make($request->all(), [
            'otDaterange_modal' => 'required',
            'person_id_modal' => 'required|numeric',
            'hour_type_id_modal' => 'required|numeric',
            'category_id_modal' => 'required|numeric',
            'destiny_type_id_modal' => 'required|numeric',
            'sub_company_id_modal' => 'required|numeric',
            'hours_modal' => 'required',
            'price_modal' => 'required|numeric'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la carga de horas masivas no es correcta', 0);

            return back()
                ->with('error_from_modal', true)
                ->withErrors($validator)
                ->withInput();
        }

        $obj_hour_ot = new HourOt();
        $obj_hour_ot->storeBulkLoadHours($ot_id, $request);
        return redirect()->route('ot.edit_hours', $ot_id)->with('success_msg', 'La carga de horas masivas se ha hecho correctamente.');
    }

    public function delete(Request $request)
    {
        $hour_ot_id = $request->hour_ot_id;
        if ($hour_ot_id > 0)
        {
            HourOt::where('hour_ot_id', $hour_ot_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

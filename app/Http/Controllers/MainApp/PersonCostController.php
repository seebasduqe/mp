<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LogEventMod;
use App\Models\MainApp\Person;
use App\Models\MainApp\PersonCost;
use App\Models\MainApp\HourType;

class PersonCostController extends Controller
{
    public function create($person_id)
    {
        $obj_person = Person::from('persons as p')
            ->where([['p.person_id', $person_id], ['sb.status', 1]])
            ->leftJoin('sub_companies as sb', 'sb.sub_company_id', '=', 'p.sub_company_id')
            ->select('p.person_id', 'p.start_date', 'sb.name as subcompany_name')
            ->first();
        $array_type_cost = HourType::select('hour_type_id', 'name')->get();
        $type = 'create';
        return view('MainApp.persons.create_cost_hour_person', compact('obj_person', 'array_type_cost', 'type'));
    }

    public function store(Request $request)
    {
        $person_id = $request->person_id;
        //Validate the person post info with the validator of laravel

        $obj_person_cost = new PersonCost();

        $obj_person_cost->saveCost($person_id, $request);


        return redirect()->route('persons.index');
    }

    public function edit($person_id)
    {
        $obj_person = Person::from('persons as p')
            ->where([['p.person_id', $person_id], ['sb.status', 1]])
            ->leftJoin('sub_companies as sb', 'sb.sub_company_id', '=', 'p.sub_company_id')
            ->select('p.person_id', 'p.start_date', 'sb.name as subcompany_name')
            ->first();

        $array_type_cost = HourType::select('hour_type_id', 'name')->get();

        $array_person_cost = PersonCost::where('person_id', $person_id)->select('hour_type_id', 'cost')->get();
        $aux_array = [];
        foreach ($array_person_cost as $person_cost)
        {
            $obj_person['type_' . $person_cost->hour_type_id . '_cost'] = $person_cost->cost;
           
        }

        $type = null;
        return view('MainApp.persons.edit_cost_hour_person', compact('obj_person', 'array_type_cost', 'type'));
    }

    public function update(Request $request, $person_id)
    {
        //Validate the person post info with the validator of laravel

        $obj_person_cost = new PersonCost();

        $obj_person_cost->saveCost($person_id, $request);

        return redirect()->route('persons.edit_cost_hour', $person_id)->with('success_msg', 'Se ha actualizado la información correctamente');
    }
}

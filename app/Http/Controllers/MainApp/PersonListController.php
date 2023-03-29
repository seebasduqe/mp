<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainApp\Person;


class PersonListController extends Controller
{
    public function index()
    {
        //Get the all sub-companies with status 1
        $array_person = Person::where('status', 1)
            ->select(
                'person_id',
                'name',
                'surnames',
                'nif',
                'telephone_1',
                'telephone_2',
                'email'

            )
            ->orderBy('person_id', 'desc')
            ->get();
        return view('MainApp.persons.list', compact('array_person'));
    }

    public function delete(Request $request)
    {

        $person_id = $request->person_id;
        if ($person_id > 0)
        {
            Person::where('person_id', $person_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

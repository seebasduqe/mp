<?php

namespace App\Http\Controllers\MainApp;

use App\Models\LogEventMod;
use Illuminate\Http\Request;
use App\Models\MainApp\Person;
use Illuminate\Validation\Rule;
use App\Models\MainApp\Category;
use App\Models\MainApp\Province;
use App\Models\MainApp\SubCompany;
use App\Http\Controllers\Controller;
use App\Models\MainApp\PersonAddress;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function create()
    {
        //Get the  subcompanies list
        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona una Sub-Empresa', '');

        //Get the  categories list
        $array_category = Category::pluck('description', 'category_id');
        $array_category->prepend('Selecciona una categoria', '');

        //Get the  provinces list
        $array_province = Province::pluck('province_name', 'province_id');
        $array_province->prepend('Selecciona una provincia', '');

        return view('MainApp.persons.create_personal_data', compact('array_sub_company', 'array_category', 'array_province'));
    }

    public function store(Request $request)
    {

        //Validate the person post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surnames' => 'required',
            'category_id' => 'required',
            'nif' => 'required|unique:persons,nif,NULL,person_id,status,1',
            'sub_company_id' => 'required',
            'town' => 'required',
            'postal_code' => 'required',
            'province_id' => 'required',
            'telephone_1' => 'required',
            'birth_date' => 'required',
            'address' => 'required',

        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la persona no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $person = Person::create([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nif' => $request->nif,
            'telephone_1' => $request->telephone_1,
            'telephone_2' => $request->telephone_2,
            'email' => $request->email,
            'leave' => $request->leave,
            'initial' => $request->initial,
            'sub_company_id' => $request->sub_company_id,
            'birth_date' => $request->birth_date,
            'category_id' => $request->category_id,
            'registration_number' => $request->registration_number,
            'liquid_payroll' => $request->liquid_payroll,
        ]);

        $person_address = PersonAddress::create([
            'address' => $request->address,
            'town' => $request->town,
            'postal_code' => $request->postal_code,
            'province_id' => $request->province_id,
        ]);

        $person->person_address_id = $person_address->person_address_id;

        $person->save();

        $person_id = $person->person_id;

        return redirect()->route('persons.create_tax_social_data', $person_id);
    }

    public function edit($person_id)
    {

        //Get the  subcompanies list
        $array_sub_company = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_sub_company->prepend('Selecciona una Sub-Empresa', '');

        //Get the  categories list
        $array_category = Category::pluck('description', 'category_id');
        $array_category->prepend('Selecciona una categoria', '');

        //Get the  provinces list
        $array_province = Province::pluck('province_name', 'province_id');
        $array_province->prepend('Selecciona una provincia', '');

        //get the obj person with the client_id pased from param
        $obj_person = Person::from('persons as p')
            ->where('p.person_id', $person_id)
            ->leftJoin('persons_address as pa', 'p.person_address_id', '=', 'pa.person_address_id')
            ->select('p.person_id', 'p.category_id', 'p.name', 'p.surnames', 'p.nif', 'p.telephone_1', 'p.telephone_2', 'p.email', 'p.leave', 'p.initial', 'p.sub_company_id', 'p.birth_date', 'pa.address', 'pa.town', 'pa.postal_code', 'pa.province_id', 'p.registration_number', 'p.liquid_payroll')
            ->first();

        return view('MainApp.persons.edit_personal_data', compact('obj_person', 'array_sub_company', 'array_category', 'array_province'));
    }

    public function update(Request $request, $person_id)
    {

        //Validate the person post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surnames' => 'required',
            'category_id' => 'required',
            'nif' => 'required|unique:persons,nif,' . $person_id . ',person_id,status,1',
            'sub_company_id' => 'required',
            'town' => 'required',
            'postal_code' => 'required',
            'province_id' => 'required',
            'telephone_1' => 'required',
            'birth_date' => 'required',
            'address' => 'required',

        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la persona no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Person::where('person_id', $person_id)->update([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nif' => $request->nif,
            'telephone_1' => $request->telephone_1,
            'telephone_2' => $request->telephone_2,
            'email' => $request->email,
            'leave' => $request->leave,
            'initial' => $request->initial,
            'sub_company_id' => $request->sub_company_id,
            'birth_date' => $request->birth_date,
            'category_id' => $request->category_id,
            'liquid_payroll' => $request->liquid_payroll,
            'registration_number' => $request->registration_number,

        ]);

        //get the client address id
        $person_address = Person::where('person_id', $person_id)->select('person_id', 'person_address_id')->first();

        PersonAddress::where('person_address_id', $person_address->person_address_id)->update([
            'address' => $request->address,
            'town' => $request->town,
            'postal_code' => $request->postal_code,
            'province_id' => $request->province_id,
        ]);

        return redirect()->route('persons.edit_personal_data', $person_id)->with('success_msg', 'Se ha actualizado la información correctamente');
    }
}

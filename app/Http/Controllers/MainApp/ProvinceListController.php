<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainApp\Province;
use App\Models\MainApp\Client;
use App\Models\MainApp\Person;

class ProvinceListController extends Controller
{
    public function index()
    {
        //Get the all provinces
        $array_province = Province::from('provinces')
            ->select(
                'province_id',
                'province_name',
                'phone_prefix',
                'code_prefix'
            )
            ->orderBy('province_name', 'desc')
            ->get();
        return view('MainApp.provinces.list', compact('array_province'));
    }

    public function delete(Request $request)
    {

        $province_id = $request->province_id;
        if ($province_id > 0)
        {
            Client::from('clients as c')
                ->where([['ca.province_id', $province_id], ['c.status', 1]])
                ->leftJoin('clients_address as ca', 'ca.client_address_id', '=', 'c.client_address_id')
                ->update(['ca.province_id' => 0]);

            Person::from('persons as p')
                ->where([['pa.province_id', $province_id], ['p.status', 1]])
                ->leftJoin('persons_address as pa', 'pa.person_address_id', '=', 'p.person_address_id')
                ->update(['pa.province_id' => 0]);

            Province::where('province_id', $province_id)->delete();
        }
        return 'success';
    }

    public function checkProvinceHasClient($province_id)
    {
        if ($province_id)
        {
            $array_province_has_clients = Client::from('clients as c')
                ->where([['ca.province_id', $province_id], ['c.status', 1]])
                ->leftJoin('clients_address as ca', 'ca.client_address_id', '=', 'c.client_address_id')
                ->select('c.client_id')
                ->get();

            $array_province_has_persons = Person::from('persons as p')
                ->where([['pa.province_id', $province_id], ['p.status', 1]])
                ->leftJoin('persons_address as pa', 'pa.person_address_id', '=', 'p.person_address_id')
                ->select('p.person_id')
                ->get();

            if (count($array_province_has_clients) > 0 || count($array_province_has_persons) > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}

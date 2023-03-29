<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainApp\Client;


class ClientListController extends Controller
{
    public function index()
    {
        //Get the all sub-companies with status 1
        $array_client = Client::from('clients as c')
            ->where('c.status', 1)
            ->leftJoin('clients_address as ca', 'ca.client_address_id', '=', 'c.client_address_id')
            ->leftJoin('sub_companies as sc', 'sc.sub_company_id', '=', 'c.sub_company_id')
            ->leftJoin('provinces as p', 'p.province_id', '=', 'ca.province_id')
            ->leftJoin('countries as co', 'co.country_id', '=', 'ca.country_id')
            ->select(
                'c.client_id',
                'c.name as client_name',
                'c.short_name',
                'sc.name as scompany_name',
                'ca.town',
                'ca.address',
                'p.province_name as province_name',
                'co.name as country_name'
            )
            ->orderBy('c.client_id', 'desc')
            ->get();
        return view('MainApp.clients.list', compact('array_client'));
    }

    public function delete(Request $request)
    {

        $client_id = $request->client_id;
        if ($client_id > 0)
        {
            Client::where('client_id', $client_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

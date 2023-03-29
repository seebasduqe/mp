<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogEventMod;
use App\Models\MainApp\HourPriceClient;
use Carbon\Carbon;

class HourPriceClientListController extends Controller
{
    public function index()
    {
        $array_hour_price = HourPriceClient::from('hours_price as hp')
            ->select('hp.hour_price_id', 'hp.cost', 'hp.pvp', 'c.name as client_name', 'sc.name as sub_company_name', 'ht.name as hour_type_name', 'j.description as job_description')
            ->leftJoin('clients as c', 'c.client_id', '=', 'hp.client_id')
            ->leftJoin('sub_companies as sc', 'sc.sub_company_id', '=', 'hp.sub_company_id')
            ->leftJoin('hours_type as ht', 'ht.hour_type_id', '=', 'hp.hour_type_id')
            ->leftJoin('jobs as j', 'j.job_id', '=', 'hp.job_id')
            ->where('hp.status', 1)
            ->orderBy('hp.hour_price_id', 'desc')
            ->get();

        return view('MainApp.hours_price_client.list', compact('array_hour_price'));
    }


    public function delete(Request $request)
    {

        $hour_price_id = $request->hour_price_id;
        if ($hour_price_id > 0)
        {
            HourPriceClient::where('hour_price_id', $hour_price_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainApp\Provider;


class ProviderListController extends Controller
{
    public function index()
    {
        //Get the all sub-providers with status 1
        $array_providers = Provider::from('providers as p')
            ->where('p.status', 1)
            ->leftJoin('sub_companies as sc', 'sc.sub_company_id', '=', 'p.sub_company_id')
            ->leftJoin('providers_address as pa', 'pa.provider_address_id', '=', 'p.provider_address_id')
            ->select(
                'p.provider_id',
                'p.name as provider_name',
                'p.nif',
                'p.email',
                'p.telephone',
                'pa.town',
                'sc.name as scompany_name'
            )
            ->orderBy('p.provider_id', 'desc')
            ->get();
        return view('MainApp.providers.list', compact('array_providers'));
    }

    public function delete(Request $request)
    {

        $provider_id = $request->provider_id;
        if ($provider_id > 0)
        {
            Provider::where('provider_id', $provider_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

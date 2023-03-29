<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainApp\SubCompany;

class SubCompanyListController extends Controller
{
    //Return sub-companies list and view list
    public function index()
    {
        //Get the all sub-companies with status 1
        $array_sub_company = SubCompany::from('sub_companies as s')
            ->where('s.status', 1)
            ->leftJoin('companies as c', 'c.company_id', '=', 's.company_id')
            ->select(
                's.sub_company_id',
                's.name',
                's.cif',
                's.address',
                's.postal_code',
                's.population',
                's.active',
                's.start_date',
                'c.name as company_name'
            )
            ->orderBy('s.sub_company_id', 'desc')
            ->get();

        //return the list view with the array of sub-companies
        return view('MainApp.sub_companies.list', compact('array_sub_company'));
    }

    //Ajax function to delete the sub-company (status=0)
    public function delete(Request $request)
    {
        //take the subcompany id from the request 
        $sub_company_id = $request->sub_company_id;
        if ($sub_company_id > 0)
        {
            //update the subcompany to status 0 
            SubCompany::where('sub_company_id', $sub_company_id)->update(['status' => 0]);
        }
        return 'success';
    }

    //Ajax funtion to toogle the active of the subcompany
    public function toggle_status(Request $request)
    {
        //take the subcompany id from the request
        $sub_company_id = $request->sub_company_id;

        //check if the action is active_on or active off
        //active_on = 1 active_off = 0
        $active = $request->action == 'active_on' ? 1 : 0;


        if ($sub_company_id > 0)
        {
            //update the active from the recuest
            SubCompany::where('sub_company_id', $sub_company_id)->update(['active' => $active]);
        }

        //return array with the action and the sub_company_id
        return ['action' => $request->action, 'sub_company_id' => $sub_company_id];
    }
}

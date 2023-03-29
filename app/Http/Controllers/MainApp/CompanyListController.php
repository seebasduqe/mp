<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainApp\Company;

class CompanyListController extends Controller
{
    //Return companies list and view list
    public function index()
    {
        //Get the all companies with status 1
        $array_company = Company::where('status', 1)->select('company_id', 'name', 'cif', 'address', 'postal_code', 'population', 'active', 'start_date')->orderBy('company_id', 'desc')->get();

        //return the list view with the array of companies
        return view('MainApp.companies.list', compact('array_company'));
    }

    public function delete(Request $request)
    {

        $company_id = $request->company_id;
        if ($company_id > 0)
        {
            Company::where('company_id', $company_id)->update(['status' => 0]);
        }
        return 'success';
    }

    public function toggle_status(Request $request)
    {

        $company_id = $request->company_id;
        $active = $request->action == 'active_on' ? 1 : 0;

        if ($company_id > 0)
        {
            Company::where('company_id', $company_id)->update(['active' => $active]);
        }
        return ['action' => $request->action, 'company_id' => $company_id];
    }
}

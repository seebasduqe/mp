<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogEventMod;
use App\Models\MainApp\OtList;
use App\Models\MainApp\Client;
use App\Models\MainApp\Person;
use App\Models\MainApp\DestinyType;
use App\Models\MainApp\OtStatus;
use App\Models\MainApp\Ot;
use App\Models\MainApp\Article;
use App\Models\MainApp\MaterialsOt;
use App\Models\MainApp\HourOt;

class OtListController extends Controller
{


    public function index(Request $request)
    {

        $array_client = Client::where('status', 1)->select('client_id', 'name')->get();
        $array_person = Person::where('status', 1)->select('person_id', 'name')->get();
        $array_destiny_type = DestinyType::select('destiny_type_id', 'name')->get();
        $array_ot_status = OtStatus::select('ot_status_id', 'name')->get();

        return view('MainApp.ot.list', compact('array_client', 'array_person', 'array_destiny_type', 'array_ot_status'));
    }

    public function getOtList(Request $request)
    {

        if (!auth()->check())
        {
            return json_encode(
                array(
                    'status' => false,
                    'redirect' => '/'
                )
            );
        }

        session(['filterSearch' => $request->filterSearch]);
        session(['filterDaterange' => $request->filterDaterange]);
        session(['filterClient' => $request->filterClient]);
        session(['filterPerson' => $request->filterPerson]);
        session(['filterDestinyType' => $request->filterDestinyType]);
        session(['filterStatus' => $request->filterStatus]);
        session(['filterYear' => $request->filterYear]);
        session(['filterQuarter' => $request->filterQuarter]);
        $obj_ot_list = new OtList();

        return json_encode($obj_ot_list->getOtList($request->all()));
    }

    public function delete(Request $request)
    {
        $ot_id = $request->ot_id;

        if ($ot_id > 0)
        {
            Ot::where('ot_id', $ot_id)->update(['status' => 0]);
            Article::where('ot_id', $ot_id)->update(['status' => 0]);
            MaterialsOt::where('ot_id', $ot_id)->update(['status' => 0]);
            HourOt::where('ot_id', $ot_id)->update(['status' => 0]);
        }

        return 'success';
    }

    public function changeStatus(Request $request)
    {
        $ot_id = $request->ot_id;
        $status_ot_id = $request->status_ot_id;

        if (isset($ot_id) && isset($status_ot_id))
        {
            Ot::where('ot_id', $ot_id)->update(['status' => $status_ot_id]);
            return 'succes';
        }
        else
        {
            return 'failed';
        }
    }
}

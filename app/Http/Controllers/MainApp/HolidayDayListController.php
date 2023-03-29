<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainApp\HolidayDay;
use App\Models\LogEventMod;
use Carbon\Carbon;

class HolidayDayListController extends Controller
{
    //function to return the view
    public function index()
    {
        return view('MainApp.holiday_days.list');
    }

    //AJAX function to return to view the holiday days
    public function getHolidayDays()
    {

        $new_array_holiday_day = [];
        $array_holiday_day = HolidayDay::select('date')->get();

        foreach ($array_holiday_day as $holiday_day)
        {
            array_push($new_array_holiday_day, $holiday_day->date->format('d/m/Y'));
        }


        return $new_array_holiday_day;
    }

    //AJAX function to save or delete the holiday day in bdd

    public function toogleHolidayDays(Request $request)
    {

        //check if request date exist
        if ($request->date != '' && $request->date != null)
        {
            //format the request date with carbon
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

            //get the date into a variable
            $check_holiday_day = HolidayDay::where('date', $date)->select('holiday_day_id')->first();

            //check if exist the day and delete or create
            if (isset($check_holiday_day) && $check_holiday_day != null)
            {
                //delete
                $check_holiday_day->delete();
            }
            else
            {
                //create
                HolidayDay::create(['date' => $date]);
            }
        }
        else
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La fecha no es correcta', 0);

            return 'error';
        }

        return 'success';
    }
}

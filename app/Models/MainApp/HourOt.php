<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourOt extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'hours_ot';

    //Define primary key
    protected $primaryKey = 'hour_ot_id';

    protected $dates = ['date'];

    //Define fields of bdd
    protected $fillable = [
        'hour_ot_id',
        'ot_id',
        'sub_company_id',
        'hour_type_id',
        'destiny_id',
        'hours',
        'price',
        'status',
        'date',
        'worksheet_number',
        'person_id',
        'destiny_type_id',
        'category_id'
    ];

    public function storeBulkLoadHours($ot_id, $data)
    {

        $arr_daterange = explode(' - ', $data->otDaterange_modal);
        $begin = date_format(date_create_from_format('d/m/Y', $arr_daterange[0]), 'Y-m-d');
        $end = date_format(date_create_from_format('d/m/Y', $arr_daterange[1]), 'Y-m-d');
        $array_dates = $this->getDateDifference($begin, $end);

        foreach ($array_dates as $date)
        {

            HourOt::create([
                'sub_company_id' => $data->sub_company_id_modal,
                'person_id' => $data->person_id_modal,
                'category_id' => $data->category_id_modal,
                'destiny_type_id' => $data->destiny_type_id_modal,
                'hours' => $data->hours_modal,
                'hour_type_id' => $data->hour_type_id_modal,
                'date' => $date,
                'price' => $data->price_modal,
                'ot_id' => $ot_id,
                'status' => 1
            ]);
        }

        return true;
    }

    private function getDateDifference($begin, $end)
    {
        $first_date = strtotime($begin);
        $second_date = strtotime($end);
        $offset = $second_date - $first_date;
        $result = array();
        for ($i = 0; $i <= floor($offset / 24 / 60 / 60); $i++)
        {
            array_push($result, date('Y-m-d', strtotime($begin . ' + ' . $i . '  days')));
        }
        return $result;
    }

    public function getHoursOt($ot_id)
    {
        $array_hour = HourOt::from('hours_ot as ho')
            ->select(
                'ho.hour_ot_id',
                'ho.ot_id',
                'p.name as person_name',
                'sb.name as sub_company_name',
                'ho.hours',
                'dt.name as destiny_type_name',
                'ht.name as hour_type_name',
                'ho.price',
                'ho.date',
                'c.description as category_description',
                'ho.worksheet_number'
            )
            ->leftJoin('persons as p', 'p.person_id', '=', 'ho.person_id')
            ->leftJoin('sub_companies as sb', 'sb.sub_company_id', '=', 'ho.sub_company_id')
            ->leftJoin('destiny_type as dt', 'dt.destiny_type_id', '=', 'ho.destiny_type_id')
            ->leftJoin('hours_type as ht', 'ht.hour_type_id', '=', 'ho.hour_type_id')
            ->leftJoin('categories as c', 'c.category_id', '=', 'ho.category_id')
            ->where([['ho.ot_id', $ot_id], ['ho.status', 1]])
            ->get();
        return $array_hour;
    }

    public function calculateResumeOtHour($array_hour)
    {
        $hours_count = 0;
        $hours_total_amount = 0;

        foreach ($array_hour as $hour)
        {
            $hours_count = $hours_count + $hour->hours;

            $amount = $hour->hours * $hour->price;

            $hours_total_amount = $hours_total_amount + $amount;
        }

        $array_resume = [
            "hours_count" => $hours_count,
            "hours_total_amount" => $hours_total_amount
        ];
        return $array_resume;
    }
}

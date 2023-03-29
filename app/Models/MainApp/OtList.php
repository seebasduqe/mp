<?php

namespace App\Models\MainApp;


use Carbon\Carbon;
use App\Models\MainApp\Ot;
use App\Models\MainApp\HourOt;
use App\Models\MainApp\Article;
use Illuminate\Support\Facades\DB;
use App\Models\MainApp\MaterialsOt;
use Illuminate\Database\Eloquent\Model;

class OtList extends Model
{
    public function getOtList($array_params = NULL)
    {

        $array_ot = Ot::from('ot as o')
            ->where('o.status', '!=', 0)
            ->leftJoin('ot as or', 'or.ot_id', '=', 'o.ot_related_id')
            ->leftJoin('clients as c', 'c.client_id', '=', 'o.client_id')
            ->leftJoin('persons as p', 'p.person_id', '=', 'o.person_id')
            ->leftJoin('ot_status as os', 'os.ot_status_id', '=', 'o.status')
            ->leftJoin('destiny_type as dt', 'dt.destiny_type_id', '=', 'o.destiny_type_id');

        /* filterSearch  */
        if (isset($array_params['filterSearch']) &&  $array_params['filterSearch'] != '')
        {
            $first = true;

            for ($i = 0; $i < count($array_params['columns']); $i++)
            {
                if ($array_params['columns'][$i]['searchable'] == "true")
                {
                    if ($first)
                    {
                        $array_ot = $array_ot->where('o.' . $array_params['columns'][$i]['data'], 'LIKE', '%' . $array_params['filterSearch'] . '%');
                        $first = false;
                    }
                    else
                    {
                        $array_ot = $array_ot->orWhere('o.' . $array_params['columns'][$i]['data'], 'LIKE', '%' . $array_params['filterSearch'] . '%');
                    }
                }
            }
        }

        /* filterClient */
        if (isset($array_params['filterClient']) && $array_params['filterClient'] != '')
        {
            $array_ot = $array_ot->where('o.client_id', $array_params['filterClient']);
        }

        /* filterPerson */
        if (isset($array_params['filterPerson']) && $array_params['filterPerson'] != '')
        {
            $array_ot = $array_ot->where('o.person_id', $array_params['filterPerson']);
        }

        /* filterStatus */
        if (isset($array_params['filterStatus']) && $array_params['filterStatus'] != '')
        {
            $array_ot = $array_ot->where('o.status', $array_params['filterStatus']);
        }

        /* filterDestinyType */
        if (isset($array_params['filterDestinyType']) && $array_params['filterDestinyType'] != '')
        {
            $array_ot = $array_ot->where('o.destiny_type_id', $array_params['filterDestinyType']);
        }

        /* filterDaterange */
        if (isset($array_params['filterDaterange']) &&  $array_params['filterDaterange'] != '')
        {
            $arr_daterange = explode(' - ', $array_params['filterDaterange']);
            $begin = date_format(date_create_from_format('d/m/Y', $arr_daterange[0]), 'Y-m-d');
            $end = date_format(date_create_from_format('d/m/Y', $arr_daterange[1]), 'Y-m-d');
            $array_ot = $array_ot->where('o.creation_date', '>=', $begin)->where('o.creation_date', '<=', $end);
        }

        /* filterQuarter needs to have filter year if no the year will be current year */
        if (isset($array_params['filterQuarter']) &&  $array_params['filterQuarter'] != '')
        {
            if ($array_params['filterYear'] != '')
            {
                $year = $array_params['filterYear'];
            }
            else
            {
                $year = date('Y');
            }
            $data_from = '';
            $data_to = '';
            switch ($array_params['filterQuarter'])
            {
                case 1:
                    $data_from = $year . '-01-01';
                    $data_to = $year . '-03-31';
                    break;

                case 2:
                    $data_from = $year . '-04-01';
                    $data_to = $year . '-06-30';
                    break;

                case 3:
                    $data_from = $year . '-07-01';
                    $data_to = $year . '-09-30';
                    break;

                case 4:
                    $data_from = $year . '-10-01';
                    $data_to = $year . '-12-31';
                    break;

                case 5:
                    $data_from = Carbon::today()->addDays(-90)->format('Y-m-d');
                    $data_to = Carbon::today()->format('Y-m-d');
                    break;

                case 'default':
                    $data_from = $year . '-01-01';
                    $data_to = $year . '-12-31';
                    break;
            }

            $array_ot = $array_ot->where('o.creation_date', '>=', $data_from)->where('o.creation_date', '<=', $data_to);
        }

        /* filterYear */
        if ($array_params['filterQuarter'] == '' && $array_params['filterYear'] != '')
        {
            if ($array_params['filterYear'] != '')
            {
                $year = $array_params['filterYear'];
            }
            else
            {
                $year = date('Y');
            }
            $data_from = $year . '-01-01';
            $data_to = $year . '-12-31';
            $array_ot = $array_ot->where('o.creation_date', '>=', $data_from)->where('o.creation_date', '<=', $data_to);
        }
        //array to get id's to do the ot resume (because we need without the limit)
        $array_ot_resume = $array_ot->select('o.ot_id')->get();
        //array to get data
        $array_ot = $array_ot->select(
            'o.ot_id',
            'o.ot_number',
            'o.ot_number_info',
            'c.name as client_name',
            'p.name as person_name',
            'dt.name as destiny_name',
            'o.description',
            'o.creation_date',
            'o.type',
            'os.ot_status_id as ot_status_id',
            'o.delivery_note_information',
            'or.ot_number as related_ot_number',
            'o.ot_related_id'
        )
            ->orderBy('ot_id', 'desc');

        $count_array_ot = $array_ot->count();
        $array_ot = $array_ot->offset($array_params['start'])->limit($array_params['length'])
            ->get();

        // get the ot resume
        $array_resume = $this->getOtResume($array_ot_resume);
        $return = array(
            'status' => true,
            'data' => $array_ot,
            'recordsTotal' =>  $count_array_ot,
            'recordsFiltered' =>  $count_array_ot,
            'arrayResume' => $array_resume,
        );

        return $return;
    }

    public function getOtResume($array_ot)
    {
        $ot_count = count($array_ot);
        $total_sales_amount = 0;
        $total_theoretical_purchase_amount = 0;
        $total_amount_real_cost = 0;
        $theoretical_margin = 0;
        $real_margin = 0;

        foreach ($array_ot as $ot)
        {
            /* calculate total sales amount */
            $total_sales_amount = $total_sales_amount + $this->calculateTotalSalesAmount($ot->ot_id);

            /* calculate total theoretical purchase amount */
            //de momento no tenemos el campo esta por definir
            $total_theoretical_purchase_amount = 0;

            /* calculate total amount real cost */
            $total_amount_real_cost = $total_amount_real_cost + $this->calculateTotalAmountRealCost($ot->ot_id);

            /* calculate theoretical margin */
            //de momento no tenemos el campo esta por definir
            $theoretical_margin = 0;
        }

        $real_margin = $total_sales_amount - $total_amount_real_cost;

        $array_resume = [
            'ot_count' => $ot_count,
            'total_sales_amount' => number_format($total_sales_amount, 2, '.', ' '),
            'total_theoretical_purchase_amount' => number_format($total_theoretical_purchase_amount, 2, '.', ' '),
            'total_amount_real_cost' => number_format($total_amount_real_cost, 2, '.', ' '),
            'theoretical_margin' => number_format($theoretical_margin, 2, '.', ' '),
            'real_margin' => number_format($real_margin, 2, '.', ' ')
        ];

        return $array_resume;
    }

    public function calculateTotalSalesAmount($ot_id)
    {
        $total_sales_amount = 0;
        $obj_article = Article::select('ot_id', 'article_id', 'quantity', 'unit_price', 'status')->where([['ot_id', $ot_id], ['status', 1]])->first();

        if (isset($obj_article) and $obj_article)
        {
            $total_sales_amount = $obj_article->quantity * $obj_article->unit_price;

            return $total_sales_amount;
        }
        else
        {
            return $total_sales_amount;
        }
    }

    public function calculateTotalAmountRealCost($ot_id)
    {
        $total_amount_real_cost = 0;
        $materials_total = 0;
        $hours_total = 0;

        $array_materials = MaterialsOt::select('material_id', 'ot_id', 'units', 'unit_price', 'status')->where([['ot_id', $ot_id], ['status', 1]])->get();
        foreach ($array_materials as $materials)
        {
            $aux = $materials->units * $materials->unit_price;
            $materials_total = $materials_total + $aux;
        }

        $array_hours_ot = HourOt::select('ot_id', 'hour_ot_id', 'hours', 'price')->where([['ot_id', $ot_id], ['status', 1]])->get();
        foreach ($array_hours_ot as $hour_ot)
        {
            $aux = $hour_ot->hours * $hour_ot->price;
            $hours_total = $hours_total + $aux;
        }

        $total_amount_real_cost = $materials_total + $hours_total;

        return $total_amount_real_cost;
    }
}

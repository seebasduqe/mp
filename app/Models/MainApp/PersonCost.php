<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MainApp\HourType;

class PersonCost extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'costs_persons';

    //Define primary key
    protected $primaryKey = 'costs_persons_id';



    //Define fields of bdd
    protected $fillable = [
        'costs_persons_id',
        'person_id',
        'hour_type_id',
        'cost'
    ];

    public function saveCost($person_id, $request)
    {
        $array_hour_type = HourType::select('hour_type_id')->get();

        foreach ($array_hour_type as $hour_type)
        {

            $aux = 'type_' . $hour_type->hour_type_id . '_cost';

            $person_cost = PersonCost::where([['person_id', $person_id], ['hour_type_id',  $hour_type->hour_type_id]])->select('costs_persons_id')->first();

            if (isset($request->$aux) && $request->$aux != null)
            {

                if (isset($person_cost) && $person_cost != null)
                {
                    $person_cost->cost =  $request->$aux;
                    $person_cost->save();
                }
                else
                {
                    PersonCost::Create([
                        'person_id' => $person_id,
                        'hour_type_id' => $hour_type->hour_type_id,
                        'cost' => $request->$aux,
                    ]);
                }
            }
            else
            {
                if (isset($person_cost) && $person_cost != null)
                {
                    $person_cost->delete();
                }
            }
        }
    }
}

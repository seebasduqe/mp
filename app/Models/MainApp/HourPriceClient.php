<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourPriceClient extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'hours_price';

    //Define primary key
    protected $primaryKey = 'hour_price_id';

    //Define fields of bdd
    protected $fillable = [
        'hour_price_id',
        'client_id',
        'hour_type_id',
        'job_id',
        'sub_company_id',
        'pvp',
        'cost'
    ];
}

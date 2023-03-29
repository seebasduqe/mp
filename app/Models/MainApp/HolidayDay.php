<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayDay extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'holiday_days';

    //Define primary key
    protected $primaryKey = 'holiday_day_id';

    protected $dates = ['date'];

    //Define fields of bdd
    protected $fillable = [
        'holiday_day_id',
        'date',
        'created_at'
    ];
}

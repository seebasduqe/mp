<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourType extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'hours_type';

    //Define primary key
    protected $primaryKey = 'hour_type_id';



    //Define fields of bdd
    protected $fillable = [
        'hour_type_id',
        'name',
        'type'
    ];
}

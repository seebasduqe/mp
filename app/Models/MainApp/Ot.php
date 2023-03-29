<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'ot';

    //Define primary key
    protected $primaryKey = 'ot_id';

    protected $dates = ['creation_date'];

    //Define fields of bdd
    protected $fillable = [
        'ot_id',
        'ot_number_info',
        'ot_number',
        'sub_company_id',
        'client_id',
        'person_id',
        'destiny_type_id',
        'description',
        'type',
        'creation_date',
        'status'
    ];
}

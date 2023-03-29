<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtStatus extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'ot_status';

    //Define primary key
    protected $primaryKey = 'ot_status_id';



    //Define fields of bdd
    protected $fillable = [
        'ot_status_id',
        'name'
    ];
}

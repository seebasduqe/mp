<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinyType extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'destiny_type';

    //Define primary key
    protected $primaryKey = 'destiny_type_id';



    //Define fields of bdd
    protected $fillable = [
        'destiny_type_id',
        'name'
    ];
}

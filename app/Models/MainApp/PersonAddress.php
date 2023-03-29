<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'persons_address';

    //Define primary key
    protected $primaryKey = 'person_address_id';

    //Define fields of bdd
    protected $fillable = [
        'person_address_id',
        'address',
        'town',
        'postal_code',
        'province_id'
    ];
}

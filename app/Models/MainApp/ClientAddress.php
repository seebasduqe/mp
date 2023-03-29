<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'clients_address';

    //Define primary key
    protected $primaryKey = 'client_address_id';

    //Define fields of bdd
    protected $fillable = [
        'client_address_id',
        'province_id',
        'postal_code',
        'country_id',
        'address',
        'town',

    ];
}

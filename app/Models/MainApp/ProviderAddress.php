<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderAddress extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'providers_address';

    //Define primary key
    protected $primaryKey = 'provider_address_id';

    //Define fields of bdd
    protected $fillable = [
        'provider_address_id',
        'address',
        'postal_code',
        'town',
        'province_id',
        'country_id'
    ];
}

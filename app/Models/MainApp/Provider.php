<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'providers';

    //Define primary key
    protected $primaryKey = 'provider_id';

    protected $dates = ['created_at'];

    //Define fields of bdd
    protected $fillable = [
        'provider_id',
        'provider_address_id',
        'sub_company_id',
        'nif',
        'nif_ue',
        'name',
        'short_name',
        'telephone',
        'email',
        'fax',
        'creation_date',
        'status',
        'created_at',
        'updated_at'
    ];
}

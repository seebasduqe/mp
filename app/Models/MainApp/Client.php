<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'clients';

    //Define primary key
    protected $primaryKey = 'client_id';

    protected $dates = ['created_at'];

    //Define fields of bdd
    protected $fillable = [
        'client_id',
        'client_address_id',
        'sub_company_id',
        'nif',
        'nif_ue',
        'name',
        'short_name',
        'status',
        'created_at'
    ];
}

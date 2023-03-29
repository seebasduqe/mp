<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'companies';

    //Define primary key
    protected $primaryKey = 'company_id';

    protected $dates = ['start_date'];

    //Define fields of bdd
    protected $fillable = [
        'company_id',
        'name',
        'cif',
        'address',
        'postal_code',
        'population',
        'status',
        'active',
        'start_date'
    ];
}

<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'persons';

    //Define primary key
    protected $primaryKey = 'person_id';

    protected $dates = ['created_at'];

    //Define fields of bdd
    protected $fillable = [
        'person_id',
        'person_address_id',
        'category_id',
        'name',
        'surnames',
        'nif',
        'telephone_1',
        'telephone_2',
        'email',
        'leave',
        'nss',
        'start_date',
        'kpqlo',
        'hash',
        'initial',
        'sub_company_id',
        'observations',
        'registration_number',
        'birth_date',
        'liquid_payroll',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCompany extends Model
{
    use HasFactory;

    protected $table = 'sub_companies';

    protected $primaryKey = 'sub_company_id';

    protected $dates = ['start_date'];

    protected $fillable = [
        'name',
        'cif',
        'address',
        'postal_code',
        'population',
        'company_id',
        'status',
        'start_date'
    ];
}

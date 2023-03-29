<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialsOt extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'materials_ot';

    //Define primary key
    protected $primaryKey = 'material_id';

    protected $dates = ['date'];

    //Define fields of bdd
    protected $fillable = [
        'material_id ',
        'ot_id',
        'sub_company_id',
        'destiny_type_id',
        'unit_type_id',
        'provider_id',
        'description',
        'consumable',
        'material_id',
        'units',
        'unit_price',
        'status',
        'date',
        'albaran_prod_ref'
    ];
}

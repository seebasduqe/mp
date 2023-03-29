<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    use HasFactory;

    protected $table = 'units_type';

    protected $primaryKey = 'units_type_id';


    protected $fillable = [
        'unit_type_id',
        'name'
    ];
}

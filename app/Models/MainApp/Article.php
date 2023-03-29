<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'articles';

    //Define primary key
    protected $primaryKey = 'acrticle_id';

    protected $dates = ['created_at'];

    //Define fields of bdd
    protected $fillable = [
        'acrticle_id',
        'ot_id',
        'quantity',
        'unit_price',
        'comments',
        'benefit',
        'attrition',
        'name'
    ];
}

<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'categories';

    //Define primary key
    protected $primaryKey = 'category_id';

    protected $dates = ['created_at'];

    //Define fields of bdd
    protected $fillable = [
        'category_id',
        'description',
        'hour_price',
        'status',
    ];
}

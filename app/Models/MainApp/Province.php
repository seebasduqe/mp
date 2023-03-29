<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

     //Define table name of bdd
     protected $table = 'provinces';

     //Define primary key
     protected $primaryKey = 'province_id'; 
 
     //Define fields of bdd
     protected $fillable = [
         'province_id',
         'province_name',
         'phone_prefix',
         'code_prefix'         
     ];
}

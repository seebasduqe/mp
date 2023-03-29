<?php

namespace App\Models\MainApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'documents_type';

    //Define primary key
    protected $primaryKey = 'document_type_id';



    //Define fields of bdd
    protected $fillable = [
        'document_type_id',
        'name'
    ];
}

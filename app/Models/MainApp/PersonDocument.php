<?php

namespace App\Models\MainApp;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDocument extends Model
{
    use HasFactory;

    //Define table name of bdd
    protected $table = 'person_documents';

    //Define primary key
    protected $primaryKey = 'document_id';


    protected $dates = ['created_at', 'expiration_date'];
    //Define fields of bdd
    protected $fillable = [
        'document_id',
        'person_id',
        'type_id',
        'name',
        'observations',
        'expiration_date',
        'created_at'

    ];


    public function save_file($file)
    {
        //creamos el nombre del excel que vamos a guardar con la extension que viene
        $file_name = Carbon::now()->format('Y_m_d_H_i_m') . $file->getClientOriginalName();
        //Guardamos en el storage el excel
        Storage::disk('local')->put('/person_documents/' . $file_name,  \File::get($file));
        //Guardamos el document url del proyecto
        $this->attributes['document_url'] = $file_name;
    }
}

<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LogEventMod;
use App\Models\MainApp\Person;
use App\Models\MainApp\DocumentType;
use App\Models\MainApp\PersonDocument;

class PersonDocumentController extends Controller
{
    public function create($person_id)
    {
        $obj_person = Person::from('persons as p')
            ->where('p.person_id', $person_id)
            ->select('p.person_id')
            ->first();
        //Get the  document type list
        $array_document = PersonDocument::from('person_documents as pd')
            ->where([['person_id', $obj_person->person_id], ['status', 1]])
            ->leftJoin('documents_type as dt', 'dt.document_type_id', '=', 'pd.type_id')
            ->select('pd.document_id', 'pd.document_url as document_url', 'pd.observations as observations', 'dt.name as type_name', 'pd.created_at', 'pd.expiration_date')
            ->orderBy('pd.document_id', 'desc')
            ->get();

        $type = 'create';
        $array_document_type = DocumentType::pluck('name', 'document_type_id');
        $array_document_type->prepend('Selecciona un tipo de documento', '');
        return view('MainApp.persons.create_document', compact('obj_person', 'array_document_type', 'array_document', 'type'));
    }

    public function store(Request $request, $person_id)
    {
        //Validate the person post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'document_file' => 'required',
            'description' => 'required',
            'document_type_id' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del documento de la persona persona no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $obj_person_document = PersonDocument::create([
            'person_id' => $person_id,
            'type_id' => $request->document_type_id,
            'observations' => $request->description,
            'expiration_date' => $request->expiration_date,
            'document_url' => ''

        ]);
        //document_file
        //Check if exist request file

        if ($request->hasFile('document_file'))
        {

            $file = $request->file('document_file');
            //Saving the file on stroage
            $obj_person_document->save_file($file);
        }
        $obj_person_document->save();
        return redirect()->route('persons.create_document', $person_id)->with('success_msg', 'Se ha añadido el documento correctamente');
    }

    public function edit($person_id)
    {
        $obj_person = Person::from('persons as p')
            ->where('p.person_id', $person_id)
            ->select('p.person_id')
            ->first();
        //Get the  document type list
        $array_document = PersonDocument::from('person_documents as pd')
            ->where([['person_id', $obj_person->person_id], ['status', 1]])
            ->leftJoin('documents_type as dt', 'dt.document_type_id', '=', 'pd.type_id')
            ->select('pd.document_id', 'pd.document_url as document_url', 'pd.observations as observations', 'dt.name as type_name', 'pd.created_at', 'pd.expiration_date')
            ->orderBy('pd.document_id', 'desc')
            ->get();

        $array_document_type = DocumentType::pluck('name', 'document_type_id');
        $array_document_type->prepend('Selecciona un tipo de documento', '');
        return view('MainApp.persons.edit_document', compact('obj_person', 'array_document_type', 'array_document'));
    }

    public function update(Request $request, $person_id, $document_id)
    {
        //Validate the person post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'document_file' => 'required',
            'description' => 'required',

            'document_type_id' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del documento de la persona persona no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($document_id > 0)
        {
            PersonDocument::where('document_id', $document_id)->update(['status' => 0]);
        }


        $obj_person_document = PersonDocument::create([
            'person_id' => $person_id,
            'type_id' => $request->document_type_id,
            'observations' => $request->description,
            'expiration_date' => $request->expiration_date,
            'document_url' => ''

        ]);


        if ($request->hasFile('document_file'))
        {

            $file = $request->file('document_file');
            //Saving the file on stroage
            $obj_person_document->save_file($file);
        }
        $obj_person_document->save();
        return redirect()->route('persons.edit_document', $person_id)->with('success_msg', 'Se ha añadido el documento correctamente');
    }

    public function delete(Request $request)
    {

        $document_id = $request->document_id;
        if ($document_id > 0)
        {
            PersonDocument::where('document_id', $document_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LogEventMod;
use App\Models\MainApp\OtDocument;
use App\Models\MainApp\OtDocumentType;
use App\Models\MainApp\Ot;

class OtDocumentController extends Controller
{
    public function create($ot_id)
    {
        $type = 'create';
        $obj_ot = Ot::from('ot as o')
            ->where('o.ot_id', $ot_id)
            ->select('o.ot_id')
            ->first();

        $array_document = OtDocument::from('ot_documents as od')
            ->where([['od.ot_id', $ot_id], ['od.status', 1]])
            ->leftJoin('ot_documents_type as dt', 'dt.document_type_id', '=', 'od.type_id')
            ->select('od.document_id', 'od.document_url', 'od.observations', 'dt.name as type_name', 'od.created_at')
            ->get();

        $array_document_type = OtDocumentType::pluck('name', 'document_type_id');
        $array_document_type->prepend('Selecciona un tipo de documento', '');
        return view('MainApp.ot.create_document', compact('type', 'obj_ot', 'array_document_type', 'array_document'));
    }

    public function edit($ot_id)
    {

        $type = 'edit';

        $obj_ot = Ot::from('ot as o')
            ->where('o.ot_id', $ot_id)
            ->select('o.ot_id')
            ->first();

        $array_document = OtDocument::from('ot_documents as od')
            ->where([['od.ot_id', $ot_id], ['od.status', 1]])
            ->leftJoin('ot_documents_type as dt', 'dt.document_type_id', '=', 'od.type_id')
            ->select('od.document_id', 'od.document_url', 'od.observations', 'dt.name as type_name', 'od.created_at')
            ->get();

        $array_document_type = OtDocumentType::pluck('name', 'document_type_id');
        $array_document_type->prepend('Selecciona un tipo de documento', '');

        return view('MainApp.ot.edit_document', compact('type', 'obj_ot', 'array_document_type', 'array_document'));
    }

    public function store(Request $request, $ot_id)
    {
        $validator = Validator::make($request->all(), [
            'document_file' => 'required',
            'description' => 'required',
            'document_type_id' => 'required'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del documento de la ot no es correcta, error al guardar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $obj_ot_document = OtDocument::create([
            'ot_id' => $ot_id,
            'type_id' => $request->document_type_id,
            'observations' => $request->description,
            'document_url' => ''

        ]);
        if ($request->hasFile('document_file'))
        {

            $file = $request->file('document_file');
            //Saving the file on stroage
            $obj_ot_document->save_file($file);
        }
        $obj_ot_document->save();
        if ($request->type == 'edit')
        {
            return redirect()->route('ot.edit_documents', $ot_id)->with('success_msg', 'Se ha añadido el documento correctamente');
        }
        else
        {
            return redirect()->route('ot.create_documents', $ot_id)->with('success_msg', 'Se ha añadido el documento correctamente');
        }
    }

    public function delete(Request $request)
    {

        $document_id = $request->document_id;
        if ($document_id > 0)
        {
            OtDocument::where('document_id', $document_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

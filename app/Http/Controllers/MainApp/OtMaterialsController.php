<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogEventMod;
use App\Models\MainApp\Ot;
use App\Models\MainApp\MaterialsOt;
use App\Models\MainApp\Provider;
use App\Models\MainApp\UnitType;
use App\Models\MainApp\DestinyType;
use App\Models\MainApp\SubCompany;
use Illuminate\Support\Facades\Validator;

class OtMaterialsController extends Controller
{

    public function create($ot_id)
    {
        $type = 'create';

        if (!$ot_id)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la creación de materiales de la ot el id de la ot ha venido nullo por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $obj_ot = Ot::from('ot as o')
            ->select('o.ot_id')
            ->where('o.ot_id', $ot_id)
            ->first();

        if (!$obj_ot && $obj_ot == '')
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la creación de materiales de la ot el id de la ot ha venido incorrecto por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $array_provider = Provider::where('status', 1)->pluck('name', 'provider_id');
        $array_provider->prepend('Selecciona un proveedor', '');

        $array_unity_type = UnitType::pluck('name', 'unit_type_id');
        $array_unity_type->prepend('Selecciona un tipo de unidad', '');

        $array_destiny_type = DestinyType::pluck('name', 'destiny_type_id');
        $array_destiny_type->prepend('Selecciona un tipo de destino', '');

        $array_subompany = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_subompany->prepend('Selecciona una subempresa', '');

        $array_materials = MaterialsOt::from('materials_ot as mo')
            ->select(
                'mo.material_id',
                'mo.ot_id',
                'sb.name as sub_company_name',
                'dt.name as destiny_type_name',
                'ut.name as unit_type_name',
                'p.name as provider_name',
                'mo.description',
                'mo.units',
                'mo.unit_price',
                'mo.total',
                'mo.consumable',
                'mo.date',
                'mo.albaran_prod_ref'
            )
            ->where([['mo.ot_id', $ot_id], ['mo.status', 1]])
            ->leftJoin('sub_companies as sb', 'sb.sub_company_id', '=', 'mo.sub_company_id')
            ->leftJoin('destiny_type as dt', 'dt.destiny_type_id', '=', 'mo.destiny_type_id')
            ->leftJoin('units_type as ut', 'ut.unit_type_id', '=', 'mo.unit_type_id')
            ->leftJoin('providers as p', 'p.provider_id', '=', 'mo.provider_id')
            ->get();

        return view('MainApp.ot.create_materials', compact('obj_ot', 'type', 'array_materials', 'array_provider', 'array_unity_type', 'array_destiny_type', 'array_subompany'));
    }

    public function edit($ot_id)
    {

        $type = 'edit';

        if (!$ot_id)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de materiales de la ot el id de la ot ha venido nullo por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $obj_ot = Ot::from('ot as o')
            ->select('o.ot_id')
            ->where('o.ot_id', $ot_id)
            ->first();


        if (!$obj_ot && $obj_ot == '')
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de materiales de la ot el id de la ot ha venido incorrecto por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }


        $array_provider = Provider::where('status', 1)->pluck('name', 'provider_id');
        $array_provider->prepend('Selecciona un proveedor', '');

        $array_unity_type = UnitType::pluck('name', 'unit_type_id');
        $array_unity_type->prepend('Selecciona un tipo de unidad', '');

        $array_destiny_type = DestinyType::pluck('name', 'destiny_type_id');
        $array_destiny_type->prepend('Selecciona un tipo de destino', '');

        $array_subompany = SubCompany::where('status', 1)->pluck('name', 'sub_company_id');
        $array_subompany->prepend('Selecciona una subempresa', '');

        $array_materials = MaterialsOt::from('materials_ot as mo')
            ->select(
                'mo.material_id',
                'mo.ot_id',
                'sb.name as sub_company_name',
                'dt.name as destiny_type_name',
                'ut.name as unit_type_name',
                'p.name as provider_name',
                'mo.description',
                'mo.units',
                'mo.unit_price',
                'mo.total',
                'mo.consumable',
                'mo.date',
                'mo.albaran_prod_ref'
            )
            ->where([['mo.ot_id', $ot_id], ['mo.status', 1]])
            ->leftJoin('sub_companies as sb', 'sb.sub_company_id', '=', 'mo.sub_company_id')
            ->leftJoin('destiny_type as dt', 'dt.destiny_type_id', '=', 'mo.destiny_type_id')
            ->leftJoin('units_type as ut', 'ut.unit_type_id', '=', 'mo.unit_type_id')
            ->leftJoin('providers as p', 'p.provider_id', '=', 'mo.provider_id')
            ->get();

        return view('MainApp.ot.edit_materials', compact('obj_ot', 'type', 'array_materials', 'array_provider', 'array_unity_type', 'array_destiny_type', 'array_subompany'));
    }


    public function store(Request $request, $ot_id)
    {


        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'destiny_type_id' => 'required',
            'provider_id' => 'required',
            'sub_company_id' => 'required',
            'date' => 'required',
            'unit_price' => 'required|numeric',
            'units' => 'required|numeric',
            'unit_type_id' => 'required|numeric'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del articulo de la ot no es correcta, error al editar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }


        MaterialsOt::create([
            'description' => $request->description,
            'destiny_type_id' => $request->destiny_type_id,
            'provider_id' => $request->provider_id,
            'sub_company_id' => $request->sub_company_id,
            'date' => $request->date,
            'unit_price' => $request->unit_price,
            'units' => $request->units,
            'unit_type_id' => $request->unit_type_id,
            'description' => $request->description,
            'albaran_prod_ref' => $request->albaran_prod_ref,
            'consumable' => $request->consumable ? $request->consumable : 0,
            'ot_id' => $ot_id
        ]);
        if ($request->type == 'edit')
        {
            return redirect()->route('ot.edit_materials', $ot_id)->with('success_msg', 'Se ha creado el material correctamente');
        }
        else
        {
            return redirect()->route('ot.create_materials', $ot_id)->with('success_msg', 'Se ha creado el material correctamente');
        }
    }

    public function delete(Request $request)
    {
        $material_id = $request->material_id;
        if ($material_id > 0)
        {
            MaterialsOt::where('material_id', $material_id)->update(['status' => 0]);
        }
        return 'success';
    }
}

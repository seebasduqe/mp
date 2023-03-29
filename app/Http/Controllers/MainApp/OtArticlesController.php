<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogEventMod;
use App\Models\MainApp\Ot;
use App\Models\MainApp\Article;
use Illuminate\Support\Facades\Validator;

class OtArticlesController extends Controller
{

    public function create($ot_id)
    {
        $type = 'create';

        if (!$ot_id)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de artículos de la ot el id de la ot ha venido nullo por get', 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $obj_ot = Ot::from('ot as o')
            ->select('ot_id')
            ->where([['o.ot_id', $ot_id], ['o.status', '!=', 0]])
            ->first();

        if (!$obj_ot && $obj_ot == '')
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de artículos de la ot el id de la ot ha venido incorrecto por get', 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        return view('MainApp.ot.create_articles', compact('obj_ot', 'type'));
    }

    public function edit($ot_id)
    {
        $type = 'edit';

        if (!$ot_id)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de artículos de la ot el id de la ot ha venido nullo por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $obj_ot = Ot::from('ot as o')
            ->select('ot_id')
            ->where([['o.ot_id', $ot_id], ['o.status', '!=', 0]])
            ->first();

        if (!$obj_ot && $obj_ot == '')
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'En la edición de artículos de la ot el id de la ot ha venido incorrecto por get. Id ot facilitado es: ' . $ot_id, 0);
            return redirect()->route('ot.index')->with('error_msg', 'Error recueprando la ot, vuelvelo a intentar.');
        }

        $obj_article = Article::from('articles as a')
            ->select(
                'a.article_id',
                'a.quantity',
                'a.unit_price',
                'a.name',
                'a.comments',
                'a.benefit',
                'a.attrition'
            )
            ->where([['a.ot_id', $ot_id], ['status', 1]])
            ->first();

        return view('MainApp.ot.edit_articles', compact('obj_ot', 'obj_article', 'type'));
    }



    /**
     * Todo - Realizar el store de la ot
     * No se van a poder actualizar las horas por lo tanto solo se tendrá el gurdado por lo tanto se tendrá que poner un input hidden para saber a que página devolver
     * 
     */
    public function store(Request $request, $ot_id)
    {
        //generar nueva ot
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'attrition' => 'required|numeric',
            'benefit' => 'required|numeric'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del articulo de la ot no es correcta, error al editar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Article::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'attrition' => $request->attrition,
            'benefit' => $request->benefit,
            'comments' => $request->comments,
            'ot_id' => $ot_id
        ]);

        return redirect()->route('ot.create_materials', $ot_id);
    }

    public function update(Request $request, $ot_id)
    {

        //generar nueva ot
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'attrition' => 'required|numeric',
            'benefit' => 'required|numeric'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información del articulo de la ot no es correcta, error al editar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Article::where('ot_id', $ot_id)->delete();

        Article::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'attrition' => $request->attrition,
            'benefit' => $request->benefit,
            'comments' => $request->comments,
            'ot_id' => $ot_id
        ]);

        return redirect()->route('ot.edit_articles', $ot_id)->with('success_msg', 'Se modificado el artículo correctamente');
    }
}

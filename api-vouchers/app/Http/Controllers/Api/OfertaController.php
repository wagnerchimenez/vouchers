<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oferta;
use Illuminate\Support\Facades\Validator;

class OfertaController extends Controller
{

    public function index()
    {
        return Oferta::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'desconto' => 'required'
        ]);

        if ($validator->fails()) {

            $erros = $validator->errors();

            return response()->json([
                'message' => $erros->first()
            ], 404);
        } else {

            $oferta = new Oferta;
            $oferta->nome = $request->nome;
            $oferta->desconto = $request->desconto;
            $oferta->save();

            return response()->json([
                'message' => 'Oferta salva com sucesso!'
            ], 200);
        }
    }

    public function show($id)
    {
        $oferta = Oferta::find($id);

        return $oferta ? $oferta : response()->json([
            'message' => 'Oferta não encontrada!'
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $oferta = Oferta::find($id);

        if ($oferta) {

            if ($request->nome) {
                $oferta->nome = $request->nome;
            }

            if ($request->desconto) {
                $oferta->desconto = $request->desconto;
            }

            $oferta->save();

            return response()->json([
                'message' => 'Oferta atualizada com sucesso!'
            ], 201);
        } else {

            return response()->json([
                'message' => 'Oferta não encontrada para edição!'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $oferta = Oferta::find($id);

        if ($oferta) {
            $oferta->delete();

            return response()->json([
                'message' => 'Oferta excluída com sucesso!'
            ], 202);
        } else {
            return response()->json([
                'message' => 'Oferta não encontrada para exclusão!'
            ], 404);
        }
    }
}

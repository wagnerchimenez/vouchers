<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'unique:clientes'
        ]);

        if ($validator->fails()) {

            $erros = $validator->errors();

            return response()->json([
                'message' => $erros->first()
            ], 404);
        } else {

            $cliente = new Cliente;
            $cliente->nome = $request->nome;
            $cliente->email = $request->email;
            $cliente->save();

            return response()->json([
                'message' => 'Cliente salvo com sucesso!'
            ], 200);
        }
    }

    public function show($id)
    {

        $cliente = Cliente::find($id);

        return $cliente ? $cliente : response()->json([
            'message' => 'Cliente não encontrado!'
        ], 404);;
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if ($cliente) {

            $validator = Validator::make($request->all(), [
                'email' => 'email|unique:clientes,email,' . $id
            ]);

            if ($validator->fails()) {

                $erros = $validator->errors();

                return response()->json([
                    'message' => $erros->first()
                ], 404);
            } else {

                if ($request->nome) {
                    $cliente->nome = $request->nome;
                }

                if ($request->email) {
                    $cliente->email = $request->email;
                }

                $cliente->save();

                return response()->json([
                    'message' => 'Cliente atualizado com sucesso!'
                ], 201);
            }
        } else {

            return response()->json([
                'message' => 'Cliente não encontrado para edição!'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente) {
            $cliente->delete();

            return response()->json([
                'message' => 'Cliente excluído com sucesso!'
            ], 202);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado para exclusão!'
            ], 404);
        }
    }
}

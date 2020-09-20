<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = json_decode(Http::get(env('API_URL') . 'clientes')->body());

        return view('clientes.index', [
            'clientes' => $clientes ? $clientes : []
        ]);
    }

    public function create()
    {
        return view('clientes.form', [
            'acao_form' => route('clientes.store')
        ]);
    }

    public function store(Request $request)
    {
        $retorno = Http::post(env('API_URL') . 'clientes' , [
            'nome' => $request->nome,
            'email' => $request->email
        ]);

        if ($retorno->status() == 200) {
            return view('clientes.sucesso', ['retorno' => json_decode($retorno->body())]);
        }else{
            return view('clientes.erro', ['retorno' => json_decode($retorno->body())]);
        }
    }

    public function show($id)
    {
        $cliente = json_decode(Http::get(env('API_URL') . 'clientes/' . $id)->body());

        return view('clientes.show', [
            'cliente' => $cliente
        ]);
    }

    public function edit($id)
    {

        $cliente = json_decode(Http::get(env('API_URL') . 'clientes/' . $id)->body());

        return view('clientes.form', [
            'cliente' => $cliente,
            'acao_form' => route('clientes.update', $id),
            'update' => true
        ]);
    }

    public function update(Request $request, $id)
    {

        $retorno = Http::put(env('API_URL') . 'clientes/' . $id, [
            'nome' => $request->nome,
            'email' => $request->email
        ]);

        if ($retorno->status() == 201) {
            return view('clientes.sucesso', ['retorno' => json_decode($retorno->body())]);
        }
    }

    public function destroy($id)
    {
        $retorno = Http::delete(env('API_URL') . 'clientes/' . $id);

        if ($retorno->status() == 202) {
            return view('clientes.sucesso', ['retorno' => json_decode($retorno->body())]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OfertaController extends Controller
{

    public function index()
    {
        $ofertas = json_decode(Http::get(env('API_URL') . 'ofertas')->body());
        return view('ofertas.index', [
            'ofertas' => $ofertas
        ]);
    }

    public function create()
    {
        return view('ofertas.form', [
            'acao_form' => route('ofertas.store')
        ]);
    }

    public function store(Request $request)
    {
        $retorno = Http::post(env('API_URL') . 'ofertas' , [
            'nome' => $request->nome,
            'desconto' => $request->desconto
        ]);

        if ($retorno->status() == 200) {
            return view('ofertas.sucesso', ['retorno' => json_decode($retorno->body())]);
        }else{
            return view('ofertas.erro', ['retorno' => json_decode($retorno->body())]);
        }
    }

    public function show($id)
    {
        $oferta = json_decode(Http::get(env('API_URL') . 'ofertas/' . $id)->body());

        return view('ofertas.show', [
            'oferta' => $oferta
        ]);
    }

    public function edit($id)
    {

        $oferta = json_decode(Http::get(env('API_URL') . 'ofertas/' . $id)->body());

        return view('ofertas.form', [
            'oferta' => $oferta,
            'acao_form' => route('ofertas.update', $id),
            'update' => true
        ]);
    }

    public function update(Request $request, $id)
    {

        $retorno = Http::put(env('API_URL') . 'ofertas/' . $id, [
            'nome' => $request->nome,
            'desconto' => $request->desconto
        ]);

        if ($retorno->status() == 201) {
            return view('ofertas.sucesso', ['retorno' => json_decode($retorno->body())]);
        }
    }

    public function destroy($id)
    {
        $retorno = Http::delete(env('API_URL') . 'ofertas/' . $id);

        if ($retorno->status() == 202) {
            return view('ofertas.sucesso', ['retorno' => json_decode($retorno->body())]);
        }
    }
}

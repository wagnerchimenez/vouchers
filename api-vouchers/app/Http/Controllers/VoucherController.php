<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoucherController extends Controller
{

    public function index()
    {
        $vouchers = json_decode(Http::get(env('API_URL') . 'vouchers')->body());

        foreach ($vouchers as &$voucher) {

            $voucher->cliente = json_decode(Http::get(env('API_URL') . 'clientes/' . $voucher->clientes_id)->body())->nome;
            $voucher->oferta = json_decode(Http::get(env('API_URL') . 'ofertas/' . $voucher->ofertas_id)->body())->nome;
        }

        return view('vouchers.index', [
            'vouchers' => $vouchers
        ]);
    }

    public function create()
    {
        return view('vouchers.form', [
            'acao_form' => route('vouchers.store'),
            'clientes' => json_decode(Http::get(env('API_URL') . 'clientes')->body()),
            'ofertas' => json_decode(Http::get(env('API_URL') . 'ofertas')->body())
        ]);
    }

    public function store(Request $request)
    {
        $retorno = Http::post(env('API_URL') . 'vouchers', [
            'clientes_id' => $request->clientes_id,
            'ofertas_id' => $request->ofertas_id,
            'expira_em' => ($request->expira_em ? date('Y-m-d', strtotime(str_replace('/', '-', $request->expira_em))) : ''),
            'utilizado_em' => ($request->utilizado_em ? date('Y-m-d', strtotime(str_replace('/', '-', $request->utilizado_em))) : ''),
        ]);

        if ($retorno->status() == 200) {
            return view('vouchers.sucesso', ['retorno' => json_decode($retorno->body())]);
        } else {
            return view('vouchers.erro', ['retorno' => json_decode($retorno->body())]);
        }
    }

    public function show($id)
    {
        $voucher = json_decode(Http::get(env('API_URL') . 'vouchers/' . $id)->body());

        $voucher->cliente = json_decode(Http::get(env('API_URL') . 'clientes/' . $voucher->clientes_id)->body())->nome;
        $voucher->oferta = json_decode(Http::get(env('API_URL') . 'ofertas/' . $voucher->ofertas_id)->body())->nome;

        return view('vouchers.show', [
            'voucher' => $voucher
        ]);
    }

    public function edit($id)
    {

        $voucher = json_decode(Http::get(env('API_URL') . 'vouchers/' . $id)->body());

        return view('vouchers.form', [
            'voucher' => $voucher,
            'clientes' => json_decode(Http::get(env('API_URL') . 'clientes')->body()),
            'ofertas' => json_decode(Http::get(env('API_URL') . 'ofertas')->body()),
            'acao_form' => route('vouchers.update', $id),
            'update' => true
        ]);
    }

    public function update(Request $request, $id)
    {

        $retorno = Http::put(env('API_URL') . 'vouchers/' . $id, [
            'clientes_id' => $request->clientes_id,
            'ofertas_id' => $request->ofertas_id,
            'expira_em' => ($request->expira_em ? date('Y-m-d', strtotime(str_replace('/', '-', $request->expira_em))) : ''),
            'utilizado_em' => ($request->utilizado_em ? date('Y-m-d', strtotime(str_replace('/', '-', $request->utilizado_em))) : ''),
        ]);

        if ($retorno->status() == 201) {
            return view('vouchers.sucesso', ['retorno' => json_decode($retorno->body())]);
        }
    }

    public function destroy($id)
    {
        $retorno = Http::delete(env('API_URL') . 'vouchers/' . $id);

        if ($retorno->status() == 202) {
            return view('vouchers.sucesso', ['retorno' => json_decode($retorno->body())]);
        }
    }
}

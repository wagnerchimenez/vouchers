<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oferta;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

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

            // Verifica se a oferta possui vouchers gerados
            $totalVouchers = $oferta->vouchers()->count();

            if ($totalVouchers > 0) {
                return response()->json([
                    'message' => 'Antes de excluir esta oferta será necessário excluir seus vouchers relacionados!'
                ], 404);
            } else {
                $oferta->delete();

                return response()->json([
                    'message' => 'Oferta excluída com sucesso!'
                ], 202);
            }
        } else {
            return response()->json([
                'message' => 'Oferta não encontrada para exclusão!'
            ], 404);
        }
    }

    /**
     * Para uma determinada oferta com uma data de expiração, gera vouchers para todos os clientes.
     *
     */
    public function gerarVouchers(Request $request, $id)
    {

        $oferta = Oferta::find($id);

        if ($oferta) {

            $clientes = Cliente::all();

            foreach ($clientes as $cliente) {

                $retorno = Http::post(env('API_URL') . 'vouchers', [
                    'clientes_id' => $cliente->id,
                    'ofertas_id' => $oferta->id,
                    'expira_em' => ($request->expira_em ? date('Y-m-d', strtotime(str_replace('/', '-', $request->expira_em))) : ''),
                ]);

                if ($retorno->status() != 200) {
                    return response()->json([
                        'message' => 'Agum erro ocorreu, não foi possível gerar voucher para o cliente ' . $cliente->nome . '! Por favor entre em contato com o suporte para que possa ser analisado o erro!'
                    ], 404);
                }
            }
            return response()->json([
                'message' => 'Vouchers gerados!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Oferta não encontrada para gerar vouchers!'
            ], 404);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{

    public function index()
    {
        return Voucher::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clientes_id' => 'required|exists:App\Models\Cliente,id',
            'ofertas_id' => 'required|exists:App\Models\Oferta,id',
            'expira_em' => 'required|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {

            $erros = $validator->errors();

            return response()->json([
                'message' => $erros->first()
            ], 404);
        } else {

            // Gera código para o voucher
            $alfabeto = array_merge(range('A', 'Z'), range('a', 'z'));
            $alfabeto_embaralhado = str_shuffle(implode('', $alfabeto));
            $hash = sha1($alfabeto_embaralhado);

            $voucher = new Voucher;
            $voucher->clientes_id = $request->clientes_id;
            $voucher->ofertas_id = $request->ofertas_id;
            $voucher->expira_em = $request->expira_em;
            $voucher->hash = $hash;
            $voucher->save();

            return response()->json([
                'message' => 'Voucher salvo com sucesso!'
            ], 200);
        }
    }

    public function show($id)
    {
        $voucher = Voucher::find($id);

        return $voucher ? $voucher : response()->json([
            'message' => 'Voucher não encontrado!'
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::find($id);

        if ($voucher) {

            $validator = Validator::make($request->all(), [
                'clientes_id' => 'required|exists:App\Models\Cliente,id',
                'ofertas_id' => 'required|exists:App\Models\Oferta,id',
                'expira_em' => 'required|date_format:Y-m-d'
            ]);

            if ($validator->fails()) {

                $erros = $validator->errors();

                return response()->json([
                    'message' => $erros->first()
                ], 404);
            } else {

                $voucher->clientes_id = $request->clientes_id;
                $voucher->ofertas_id = $request->ofertas_id;
                $voucher->expira_em = $request->expira_em;
                $voucher->save();

                return response()->json([
                    'message' => 'Voucher atualizada com sucesso!'
                ], 201);
            }
        } else {

            return response()->json([
                'message' => 'Voucher não encontrado para edição!'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);

        if ($voucher) {
            $voucher->delete();

            return response()->json([
                'message' => 'Voucher excluído com sucesso!'
            ], 202);
        } else {
            return response()->json([
                'message' => 'Voucher não encontrado para exclusão!'
            ], 404);
        }
    }

    public function validar(Request $request)
    {
        $voucher = Voucher::select('vouchers.*', 'ofertas.desconto as desconto')
            ->join('clientes', 'clientes.id', '=', 'vouchers.clientes_id')
            ->join('ofertas', 'ofertas.id', '=', 'vouchers.ofertas_id')
            ->where('vouchers.hash', $request->voucher_code)
            ->where('clientes.email', $request->email)
            ->first();

        if ($voucher) {

            if (!$voucher->utilizado_em) {

                $voucher->utilizado_em = date('Y-m-d');
                $voucher->save();

                return response()->json([
                    'message' => 'Voucher validado! ' . $voucher->desconto . '% de desconto'
                ], 200);
            } else {

                return response()->json([
                    'message' => 'Voucher utilizado em ' . date('d/m/Y', strtotime($voucher->utilizado_em)) . '!'
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Voucher não encontrado!'
            ], 404);
        }
    }

    public function vouchersValidos(Request $request)
    {

        $vouchers = Voucher::select('vouchers.*', 'clientes.nome as cliente', 'ofertas.nome as oferta')
            ->join('clientes', 'clientes.id', '=', 'vouchers.clientes_id')
            ->join('ofertas', 'ofertas.id', '=', 'vouchers.ofertas_id')
            ->where('clientes.email', $request->email)
            ->where('vouchers.utilizado_em', '!=', null)
            ->get();

        if ($vouchers->count()) {

            return response()->json([
                'message' => 'OK',
                'vouchers' => $vouchers
            ], 200);
        } else {
            return response()->json([
                'message' => 'Desculpe, ainda não temos vouchers válidados para este email!'
            ], 404);
        }
    }
}

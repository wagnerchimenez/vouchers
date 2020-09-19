<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;

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
            $alfabeto_embaralhado = str_shuffle(implode('',$alfabeto));
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
}

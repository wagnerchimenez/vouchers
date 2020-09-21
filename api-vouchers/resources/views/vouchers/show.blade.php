@extends('template')

@section('conteudo')

<h3>Voucher</h3>

<div class="card">
    <div class="card-body">
        <p><strong>CODE:</strong> {{ $voucher->hash }}</p>
        <p><strong>CLIENTE:</strong> {{ $voucher->cliente }}</p>
        <p><strong>OFERTA:</strong> {{ $voucher->oferta }}</p>
        <p><strong>DATA DE EXPIRAÇÃO:</strong> {{ ($voucher->expira_em) ? date('d/m/Y', strtotime($voucher->expira_em)) : '' }}</p>
        <p><strong>DATA DE UTILIZAÇÃO:</strong> {{ ($voucher->utilizado_em) ? date('d/m/Y', strtotime($voucher->utilizado_em)) : '' }}</p>
    </div>
</div>

<a href="{{ route('vouchers.index') }}" class="btn btn-link">Voltar</a>

@endsection

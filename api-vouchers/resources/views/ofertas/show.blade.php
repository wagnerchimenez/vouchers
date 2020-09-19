@extends('template')

@section('conteudo')

<h3>Oferta</h3>

<div class="card">
    <div class="card-body">
        <p><strong>NOME:</strong> {{ $oferta->nome }}</p>
        <p><strong>PORCENTAGEM DE DESCONTO:</strong> {{ $oferta->desconto }}%</p>
    </div>
</div>

<a href="{{ route('ofertas.index') }}" class="btn btn-link">Voltar</a>

@endsection

@extends('template')

@section('conteudo')

<h3>Cliente</h3>

<div class="card">
    <div class="card-body">
        <p><strong>NOME:</strong> {{ $cliente->nome }}</p>
        <p><strong>E-MAIL:</strong> {{ $cliente->email }}</p>
    </div>
</div>

<a href="{{ route('clientes.index') }}" class="btn btn-link">Voltar</a>

@endsection

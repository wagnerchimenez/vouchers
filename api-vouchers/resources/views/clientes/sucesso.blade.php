@extends('template')

@section('conteudo')

<div class="alert alert-success" role="alert">
    {{ $retorno->message }}
</div>

<a href="{{ route('clientes.index') }}" class="btn btn-link">Listar clientes</a>

@endsection

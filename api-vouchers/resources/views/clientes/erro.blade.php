@extends('template')

@section('conteudo')

<div class="alert alert-danger" role="alert">
    {{ $retorno->message }}
</div>

<a href="{{ route('clientes.index') }}" class="btn btn-link">Listar clientes</a>
<a href="{{ route('clientes.create') }}" class="btn btn-primary">Novo</a>

@endsection

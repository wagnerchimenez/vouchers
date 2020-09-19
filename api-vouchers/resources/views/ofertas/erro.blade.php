@extends('template')

@section('conteudo')

<div class="alert alert-danger" role="alert">
    {{ $retorno->message }}
</div>

<a href="{{ route('ofertas.index') }}" class="btn btn-link">Listar ofertas</a>
<a href="{{ route('ofertas.create') }}" class="btn btn-primary">Novo</a>

@endsection

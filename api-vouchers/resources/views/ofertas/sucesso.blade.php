@extends('template')

@section('conteudo')

<div class="alert alert-success" role="alert">
    {{ $retorno->message }}
</div>

<a href="{{ route('ofertas.index') }}" class="btn btn-link">Listar ofertas</a>

@endsection

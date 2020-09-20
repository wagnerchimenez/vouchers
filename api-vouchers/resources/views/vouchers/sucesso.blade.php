@extends('template')

@section('conteudo')

<div class="alert alert-success" role="alert">
    {{ $retorno->message }}
</div>

<a href="{{ route('vouchers.index') }}" class="btn btn-link">Listar vouchers</a>

@endsection

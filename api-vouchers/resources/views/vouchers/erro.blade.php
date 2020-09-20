@extends('template')

@section('conteudo')

<div class="alert alert-danger" role="alert">
    {{ $retorno->message }}
</div>

<a href="{{ route('vouchers.index') }}" class="btn btn-link">Listar vouchers</a>
<a href="{{ route('vouchers.create') }}" class="btn btn-primary">Novo</a>

@endsection

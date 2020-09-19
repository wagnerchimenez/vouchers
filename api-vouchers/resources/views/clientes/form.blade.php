@extends('template')

@section('conteudo')

<h3>Cliente</h3>

<form action="{{ $acao_form }}" method="post" enctype="multipart/form-data">

    @csrf

    @if (isset($update) && ($update === true))

        @method('PUT')

    @endif

    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome ?? old('nome') }}">
    </div>
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ $cliente->email ?? old('email') }}">
    </div>

    <a href="{{ route('clientes.index') }}" class="btn btn-link">Voltar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>

</form>

@endsection

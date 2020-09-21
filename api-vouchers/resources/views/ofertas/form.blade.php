@extends('template')

@section('conteudo')

<h3>Oferta</h3>

<form action="{{ $acao_form }}" method="post" enctype="multipart/form-data">

    @csrf

    @if (isset($update) && ($update === true))

        @method('PUT')

    @endif

    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" value="{{ $oferta->nome ?? old('nome') }}">
    </div>
    <div class="form-group">
      <label for="desconto">Porcentagem de desconto</label>
      <input type="text" class="form-control" id="desconto" name="desconto" value="{{ $oferta->desconto ?? old('desconto') }}">
    </div>

    <a href="{{ route('ofertas.index') }}" class="btn btn-link">Voltar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>

</form>

@endsection

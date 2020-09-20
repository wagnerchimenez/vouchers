@extends('template')

@section('conteudo')

<h3>Gerar vouchers</h3>

<form action="{{ $acao_form }}" method="post" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <label for="expira_em">Data de expiração</label>
        <input type="text" class="form-control date" id="expira_em" name="expira_em" data-mask="00/00/0000">
      </div>

    <a href="{{ route('ofertas.index') }}" class="btn btn-link">Voltar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>

</form>

@endsection

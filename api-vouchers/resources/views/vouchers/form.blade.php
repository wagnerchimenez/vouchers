@extends('template')

@section('conteudo')

<h3>Voucher</h3>

<form action="{{ $acao_form }}" method="post" enctype="multipart/form-data">

    @csrf

    @if (isset($update) && ($update === true))

        @method('PUT')

    @endif

    <div class="form-group">
      <label for="clientes_id">Cliente</label>
      <select name="clientes_id" id="clientes_id" class="form-control">
          <option value="">Selecione...</option>
          @foreach ($clientes as $cliente)
            <option value="{{ $cliente->id }}" {{ (($voucher->clientes_id ?? old('clientes_id')) !== null) && (($voucher->clientes_id ?? old('clientes_id')) == $cliente->id) ? 'selected' : '' }}>{{ $cliente->nome }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="ofertas_id">Oferta</label>
      <select name="ofertas_id" id="ofertas_id" class="form-control">
          <option value="">Selecione...</option>
          @foreach ($ofertas as $oferta)
              <option value="{{ $oferta->id }}" {{ (($voucher->ofertas_id ?? old('ofertas_id')) !== null) && (($voucher->ofertas_id ?? old('ofertas_id')) == $oferta->id) ? 'selected' : '' }}>{{ $oferta->nome }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="expira_em">Data de expiração</label>
      <input type="text" class="form-control date" id="expira_em" name="expira_em" value="{{ isset($voucher->expira_em) ? date('d/m/Y', strtotime($voucher->expira_em)) : '' }}" data-mask="00/00/0000">
    </div>
    <div class="form-group">
      <label for="utilizado_em">Data de utilização</label>
      <input type="text" class="form-control date" id="utilizado_em" name="utilizado_em" value="{{ isset($voucher->utilizado_em) ? date('d/m/Y', strtotime($voucher->utilizado_em)) : '' }}">
    </div>

    <a href="{{ route('vouchers.index') }}" class="btn btn-link">Voltar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>

</form>

@endsection

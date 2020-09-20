@extends('template')

@section('conteudo')

<h3>Validar voucher</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $acao_form }}" method="post" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
    </div>

    <a href="{{ route('vouchers.index') }}" class="btn btn-link">Voltar</a>
    <button type="submit" class="btn btn-primary">Buscar</button>

</form>

@endsection

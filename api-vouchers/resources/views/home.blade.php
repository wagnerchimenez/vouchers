@extends('template')

@section('conteudo')

<h3>Home</h3>

<ul>
    <li>
        <a href="{{ route('clientes.index') }}" class="btn btn-link">Clientes</a>
    </li>
    <li>
        <a href="{{ route('ofertas.index') }}" class="btn btn-link">Ofertas</a>
    </li>
    <li>
        <a href="{{ route('vouchers.index') }}" class="btn btn-link">Vouchers</a>
    </li>
    <li>
        <a href="{{ route('vouchers.validar') }}" class="btn btn-link">Validar voucher</a>
    </li>
</ul>

@endsection

@extends('template')

@section('conteudo')

<h3>Vouchers</h3>

<div class="col-12">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Oferta</th>
            <th scope="col">Cliente</th>
            <th scope="col">Data de expiração</th>
            <th scope="col">Data de utilização</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

            @foreach ($vouchers as $voucher)
                <tr>
                    <th scope="row">{{ $voucher->id }}</th>
                    <td>
                        <a target="_blank" href="{{ route('ofertas.show', [$voucher->ofertas_id]) }}" class="btn btn-link">{{ $voucher->oferta }}</a>
                    </td>
                    <td>
                        <a target="_blank" href="{{ route('clientes.show', [$voucher->clientes_id]) }}" class="btn btn-link">{{ $voucher->cliente }}</a>
                    </td>
                    <td>{{ ($voucher->expira_em) ? date('d/m/Y', strtotime($voucher->expira_em)) : '' }} </td>
                    <td>{{ ($voucher->utilizado_em) ? date('d/m/Y', strtotime($voucher->utilizado_em)) : '' }} </td>
                    <td>
                        <a href="{{ route('vouchers.edit', [$voucher->id]) }}" class="btn btn-link">Editar</a>
                        <a href="{{ route('vouchers.show', [$voucher->id]) }}" class="btn btn-link">Visualizar</a>

                        <form style="display:inline;" action="{{ route('vouchers.destroy', [$voucher->id]) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">

                            @csrf
                            @method('DELETE')

                            <button title="Excluir" class="btn btn-link" type="submit">
                                Excluir
                            </button>

                        </form>

                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

</div>

<div class="col-12">
    <a href="{{ route('home') }}" class="btn btn-link">Home</a>
    <a href="{{ route('vouchers.create') }}" class="btn btn-primary">Novo</a>
</div>

@endsection

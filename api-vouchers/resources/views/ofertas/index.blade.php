@extends('template')

@section('conteudo')

<h3>Ofertas</h3>

<div class="col-12">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Porcentagem de desconto</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

            @foreach ($ofertas as $oferta)
                <tr>
                    <th scope="row">{{ $oferta->id }}</th>
                    <td>{{ $oferta->nome }}</td>
                    <td>{{ $oferta->desconto }}% </td>
                    <td>
                        <a href="{{ route('ofertas.voucher.create', [$oferta->id]) }}" class="btn btn-link">Gerar vouchers</a>
                        <a href="{{ route('ofertas.edit', [$oferta->id]) }}" class="btn btn-link">Editar</a>
                        <a href="{{ route('ofertas.show', [$oferta->id]) }}" class="btn btn-link">Visualizar</a>

                        <form style="display:inline;" action="{{ route('ofertas.destroy', [$oferta->id]) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">

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
    <a href="{{ route('ofertas.create') }}" class="btn btn-primary">Novo</a>
</div>

@endsection

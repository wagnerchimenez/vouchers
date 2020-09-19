@extends('template')

@section('conteudo')

<h3>Clientes</h3>

<div class="col-12">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

            @foreach ($clientes as $cliente)
                <tr>
                    <th scope="row">{{ $cliente->id }}</th>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', [$cliente->id]) }}" class="btn btn-link">Editar</a>
                        <a href="{{ route('clientes.show', [$cliente->id]) }}" class="btn btn-link">Visualizar</a>

                        <form style="display:inline;" action="{{ route('clientes.destroy', [$cliente->id]) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">

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
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Novo</a>
</div>

@endsection

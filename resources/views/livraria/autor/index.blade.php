@extends('layouts.livraria')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h3>Autores</h3>
    <div class="col-12">
        @if(sizeof($autores) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach($autores as $autor)
                    <tbody>
                        <tr>
                            <td>{{ $autor->CodAu }}</td>
                            <td>{{ $autor->Nome }}</td>
                            <td>
                                <button type="button" class="btn btn-info">
                                    <a class="text-decoration-none text-white" href="{{ route('autor.edit', [ 'autor' => $autor->CodAu ])  }}">Editar</a>
                                </button>
                                <button type="button" class="btn btn-danger">
                                    <a class="text-decoration-none text-white" onclick="confirmaRemocao({{ $autor->CodAu }})">Remover</a>
                                </button>

                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        @else
        <p>Nenhum resultado encontrado</p>
        @endif
        <button type="button" class="btn btn-success">
            <a class="text-decoration-none text-reset" href="{{ route('autor.create') }}">Cadastrar novo autor</a>
        </button>
    </div>

    <script type="text/javascript">
        function confirmaRemocao(id) {
            if(confirm('Tem certeza que deseja remover o registro?')) {
                fetch(`/autor/${id}`, {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-Token": "{{ csrf_token() }}"
                    }
                }).then(() => {
                    window.location.href = "{{ route('autor.index')  }}"
                });
            }
        }
    </script>
@endsection
@extends('layouts.livraria')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h3>Assuntos</h3>
    <div class="col-12">
        @if(sizeof($assuntos) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach($assuntos as $assunto)
                    <tbody>
                        <tr>
                            <td>{{ $assunto->CodAs }}</td>
                            <td>{{ $assunto->Descricao }}</td>
                            <td>
                                <button type="button" class="btn btn-info">
                                    <a class="text-decoration-none text-white" href="{{ route('assunto.edit', [ 'assunto' => $assunto->CodAs ])  }}">Editar</a>
                                </button>
                                <button type="button" class="btn btn-danger">
                                    <a class="text-decoration-none text-white" onclick="confirmaRemocao({{ $assunto->CodAs }})">Remover</a>
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
            <a class="text-decoration-none text-reset" href="{{ route('assunto.create') }}">Cadastrar novo assunto</a>
        </button>
    </div>

    <script type="text/javascript">
        function confirmaRemocao(id) {
            if(confirm('Tem certeza que deseja remover o registro?')) {
                fetch(`/assunto/${id}`, {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-Token": "{{ csrf_token() }}"
                    }
                }).then(() => {
                    window.location.href = "{{ route('assunto.index')  }}"
                });
            }
        }
    </script>
@endsection
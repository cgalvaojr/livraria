@extends('layouts.livraria')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h3>Livros</h3>
    <div class="col-12">
        @if(sizeof($livros) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Assunto(s)</th>
                        <th>Autor(es)</th>
                        <th>Editora</th>
                        <th>Edicao</th>
                        <th>Ano Publicação</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach($livros as $livro)
                    <tbody>
                        <tr>
                            <td>{{ $livro->Codl }}</td>
                            <td>{{ $livro->Titulo }}</td>
                            <td>
                                @foreach($livro->assuntos()->get() as $assunto)
                                    <div>{{$assunto->Descricao}}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach($livro->autores()->get() as $autor)
                                    <div>{{$autor->Nome}}</div>
                                @endforeach
                            </td>
                            <td>{{ $livro->Editora }}</td>
                            <td>{{ $livro->Edicao }}</td>
                            <td>{{ $livro->AnoPublicacao }}</td>
                            <td>R$ {{ number_format($livro->Valor, 2, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn btn-info">
                                    <a class="text-decoration-none text-white" href="{{ route('livro.edit', [ 'livro' => $livro->Codl ])  }}">Editar</a>
                                </button>
                                <button type="button" class="btn btn-danger">
                                    <a class="text-decoration-none text-white" onclick="confirmaRemocao({{ $livro->Codl }})">Remover</a>
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
            <a class="text-decoration-none text-reset" href="{{ route('livro.create') }}">Cadastrar novo livro</a>
        </button>
    </div>

    <script type="text/javascript">
        function confirmaRemocao(id) {
            if(confirm('Tem certeza que deseja remover o registro?')) {
                fetch(`/livro/${id}`, {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-Token": "{{ csrf_token() }}"
                    }
                }).then(() => {
                    window.location.href = "{{ route('livro.index')  }}"
                });
            }
        }
    </script>
@endsection
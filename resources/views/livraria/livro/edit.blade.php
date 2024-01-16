@extends('layouts.livraria')
@section('content')
    <h3>Editando livro</h3>
    <form class="form-inline" method="POST" action="{{ route('livro.update', [ 'livro' => $livro->Codl ]) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-4">
                <label for="Titulo" class="col-form-label">Titulo</label>
                <input type="text" class="form-control" name="Titulo" value="{{ $livro->Titulo }}" />
            </div>
            <div class="col-4">
                <label for="Editora" class="col-form-label">Editora</label>
                <input type="text" class="form-control" name="Editora" value="{{ $livro->Editora }}" />
            </div>
            <div class="col-3">
                <label for="Edicao" class="col-form-label">Edição</label>
                <input type="number" class="form-control" name="Edicao" value="{{ $livro->Edicao }}" />
            </div>
            <div class="col-3">
                <label for="AnoPublicacao" class="col-form-label">Ano Publicação</label>
                <input type="number" class="form-control" name="AnoPublicacao" value="{{ $livro->AnoPublicacao }}"/>
            </div>
            <div class="col-3">
                <label for="Valor" class="col-form-label">Valor</label>
                <input value="{{ number_format($livro->Valor, 2, ',', '.') }}" oninput="formatarValor(this)" type="text" id="valor" placeholder="R$" class="form-control" name="Valor" />
            </div>

            <div class="row">
                <label for="Autor" class="col-form-label">Autor(es)</label>
                @foreach ($autores as $index => $autor)
                    <div class="col-3">
                        <input @foreach ($livro->autores as $livroAutor) @if($autor->CodAu == $livroAutor->CodAu ) checked @endif @endforeach name="Autor[]" type="checkbox" value="{{ $autor->CodAu }}"> {{ $autor->Nome }}
                    </div>
                @endforeach
            </div>

            <div class="row mt-2">
                <label for="Assunto" class="col-form-label">Assunto(s)</label>
                @foreach ($assuntos as $assunto)
                    <div class="col-3">
                        <input @foreach ($livro->assuntos as $livroAssunto) @if($assunto->CodAs == $livroAssunto->CodAs ) checked @endif @endforeach  name="Assunto[]" type="checkbox" value="{{ $assunto->CodAs }}" @selected(old('assunto') == $assunto)> {{ $assunto->Descricao }}
                    </div>
                @endforeach
            </div>


        </div>

        <input type="submit" value="Alterar livro" class="btn btn-success mt-2" />
    </form>

    <script type="text/javascript">
        function formatarValor(input) {
            let valor = input.value.replace(/\D/g, '');
            valor = (Number(valor) / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            input.value = valor;
        }
    </script>

@endsection

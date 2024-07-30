@extends('layouts.livraria')
@section('content')
    <h3>Cadastrar livro</h3>
    <form class="form-inline" method="POST" action="{{ route('livro.store') }}">
        @csrf
        <div class="row">
            <div class="col-4">
                <label for="Titulo" class="col-form-label">Titulo</label>
                <input type="text" class="form-control" name="Titulo" value="{{ old('Titulo') }}" />
            </div>
            <div class="col-4">
                <label for="Editora" class="col-form-label">Editora</label>
                <input type="text" class="form-control" name="Editora" value="{{ old('Editora') }}" />
            </div>
            <div class="col-3">
                <label for="Edicao" class="col-form-label">Edição</label>
                <input type="number" class="form-control" name="Edicao" value="{{ old('Edicao') }}" />
            </div>
            <div class="col-3">
                <label for="AnoPublicacao" class="col-form-label">Ano Publicação</label>
                <input type="number" class="form-control" name="AnoPublicacao" value="{{ old('AnoPublicacao') }}" />
            </div>
            <div class="col-3">
                <label for="Valor" class="col-form-label">Valor</label>
                <input oninput="formatarValor(this)" type="text" id="valor" placeholder="R$" class="form-control" name="Valor" value="{{ old('Valor') }}" />            </div>

            <div class="row">
                <label for="Autor" class="col-form-label">Autor(es)</label>
                @foreach ($autores as $autor)
                    <div class="col-3">
                        <input name="Autor[]" type="checkbox" value="{{ $autor->CodAu }}" @checked(in_array($autor->CodAu, old('Autor', [])))> {{ $autor->Nome }}
                    </div>
                @endforeach
            </div>

            <div class="row mt-2">
                <label for="Assunto" class="col-form-label">Assunto(s)</label>
                @foreach ($assuntos as $assunto)
                    <div class="col-3">
                        <input name="Assunto[]" type="checkbox" value="{{ $assunto->CodAs }}" @checked(in_array($assunto->CodAs, old('Assunto', [])))> {{ $assunto->Descricao }}                    </div>
                @endforeach
            </div>


        </div>

        <input type="submit" value="Cadastrar livro" class="btn btn-success mt-2" />
    </form>

    <script type="text/javascript">
        function formatarValor(input) {
            let valor = input.value.replace(/\D/g, '');
            valor = (Number(valor) / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            input.value = valor;
        }
    </script>

@endsection
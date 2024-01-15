@extends('layouts.livraria')
@section('content')
    <h3>Editando autor</h3>
    <form class="form-inline" method="POST" action="{{ route('autor.update', [ 'autor' => $autor->CodAu ]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4">
                <label for="CodAu" class="col-form-label">Código do Autor</label>
                <input type="text" class="form-control" name="CodAu" disabled readonly value="{{ $autor->CodAu  }}"/>
            </div>

            <div class="col-8">
                <label for="CodAu" class="col-form-label">Nome do Autor</label>
                <input type="text" class="form-control" name="Nome" value="{{ $autor->Nome  }}" />
            </div>
        </div>

        <input type="submit" class="btn btn-success mt-2" />
    </form>

@endsection
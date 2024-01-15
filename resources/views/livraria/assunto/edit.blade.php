@extends('layouts.livraria')
@section('content')
    <h3>Editando assunto</h3>
    <form class="form-inline" method="POST" action="{{ route('assunto.update', [ 'assunto' => $assunto->CodAs ]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4">
                <label for="CodAs" class="col-form-label">Código do Assunto</label>
                <input type="text" class="form-control" name="CodAs" disabled readonly value="{{ $assunto->CodAs  }}"/>
            </div>

            <div class="col-8">
                <label for="Descricao" class="col-form-label">Descrição</label>
                <input type="text" class="form-control" name="Descricao" value="{{ $assunto->Descricao  }}" />
            </div>
        </div>

        <input type="submit" class="btn btn-success mt-2" />
    </form>

@endsection
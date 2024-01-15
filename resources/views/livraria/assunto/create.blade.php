@extends('layouts.livraria')
@section('content')
    <h3>Cadastrar assunto</h3>
    <form class="form-inline" method="POST" action="{{ route('assunto.store') }}">
        @csrf
        <div class="row">
            <div class="col-8">
                <label for="Descricao" class="col-form-label">Descrição</label>
                <input type="text" class="form-control" name="Descricao" />
            </div>
        </div>

        <input type="submit" class="btn btn-success mt-2" />
    </form>

@endsection
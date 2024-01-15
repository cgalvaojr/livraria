@extends('layouts.livraria')
@section('content')
    <h3>Cadastrar autor</h3>
    <form class="form-inline" method="POST" action="{{ route('autor.store') }}">
        @csrf
        <div class="row">
            <div class="col-8">
                <label for="Nome" class="col-form-label">Nome do Autor</label>
                <input type="text" class="form-control" name="Nome" />
            </div>
        </div>

        <input type="submit" class="btn btn-success mt-2" />
    </form>

@endsection
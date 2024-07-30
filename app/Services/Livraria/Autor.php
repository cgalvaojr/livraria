<?php

namespace App\Services\Livraria;

use App\Models\Autor as AutorModel;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class Autor implements ServiceInterface
{

    #[\Override] public function salvar(array $dados): AutorModel
    {
        return AutorModel::firstOrCreate($dados);
    }

    #[\Override] public function alterar(array $dados, int $id): int
    {
        return AutorModel::where('CodAu', $id)->update($dados);
    }

    #[\Override] public function listar(int $id = null): AutorModel| Collection
    {
        if($id) {
            return AutorModel::findOrFail($id);
        }
        return AutorModel::all();
    }

    #[\Override] public function remover(int $id): bool
    {
        $autor = AutorModel::findOrFail($id);
        if ($autor->livro()->exists()) {
            throw new \Exception('Não foi possível remover o autor, pois existe livro relacionado a ele.');
        }
        $autor->destroy($id);
        return true;
    }
}
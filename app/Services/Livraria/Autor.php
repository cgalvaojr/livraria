<?php

namespace App\Services\Livraria;

use App\Models\Autor as AutorModel;
use App\Services\ServiceInterface;

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

    #[\Override] public function recuperar(int $id): AutorModel
    {
        return AutorModel::findOrFail($id)->first();
    }

    #[\Override] public function remover(int $id): bool
    {
       AutorModel::destroy($id);
       return true;
    }
}
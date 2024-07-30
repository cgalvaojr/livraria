<?php

namespace App\Services\Livraria;

use App\Models\Assunto as AssuntoModel;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class Assunto implements ServiceInterface
{

    #[\Override] public function salvar(array $dados): AssuntoModel
    {
        return AssuntoModel::firstOrCreate($dados);
    }

    #[\Override] public function alterar(array $dados, int $id): int
    {
        return AssuntoModel::where('CodAs', $id)->update($dados);
    }

    #[\Override] public function listar(int $id = null): AssuntoModel| Collection
    {
        if($id) {
            return AssuntoModel::findOrFail($id);
        }
        return AssuntoModel::all();
    }

    #[\Override] public function remover(int $id): bool
    {
        $assunto = AssuntoModel::findOrFail($id);

        if ($assunto->livro()->exists()) {
            throw new \Exception('Não foi possível remover o assunto, pois existe livro relacionado a ele.');
        }

        AssuntoModel::destroy($id);
        return true;
    }
}
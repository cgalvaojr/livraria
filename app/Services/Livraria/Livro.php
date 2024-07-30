<?php

namespace App\Services\Livraria;

use App\Models\Livro as LivroModel;
use App\Models\Livro_Autor as LivroAutorModel;
use App\Models\Livro_Assunto as LivroAssuntoModel;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\NoReturn;

class Livro implements ServiceInterface
{
    #[\Override] public function salvar(array $dados, $updateId = null): ?LivroModel
    {

        try {
            DB::beginTransaction();

            $livroPayload = [
                'Titulo' => $dados['Titulo'],
                'Editora' => $dados['Editora'],
                'Edicao' => $dados['Edicao'],
                'AnoPublicacao' => $dados['AnoPublicacao'],
                'Valor' => $this->verificarValor($dados['Valor']),
            ];

            $livro = null;

            if ($updateId) {
                LivroAutorModel::destroy($updateId);
                LivroAssuntoModel::destroy($updateId);
                $livro = LivroModel::updateOrCreate(['Codl' => $updateId], $livroPayload);
            } else {
                $livro = LivroModel::create($livroPayload);
            }

            foreach($dados['Autor'] as $autor) {
                LivroAutorModel::create([
                    'Livro_Codl' => $livro->Codl,
                    'Autor_CodAu' => $autor
                ]);
            }

            foreach($dados['Assunto'] as $assunto) {
                LivroAssuntoModel::create([
                    'Livro_Codl' => $livro->Codl,
                    'Assunto_codAs' => $assunto
                ]);
            }

            DB::commit();
            return $livro;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    #[NoReturn] private function verificarValor($valor): string
    {
        $valor = preg_replace('/\D/', '', $valor);
        $valor = number_format(($valor / 100), 2);
        return str_replace(',', '', $valor);
    }

    #[\Override] public function alterar(array $dados, int $id): int
    {
        return LivroModel::where('Codl', $id)->update($dados);
    }

    #[\Override] public function listar(int $id = null): LivroModel|Collection
    {
        if($id) {
            return LivroModel::findOrFail($id);
        }
        return LivroModel::all();
    }

    #[\Override] public function remover(int $id): bool
    {
       LivroModel::destroy($id);
       LivroAssuntoModel::where('Livro_Codl', $id)->delete();
       LivroAutorModel::where('Livro_Codl', $id)->delete();
       return true;
    }
}
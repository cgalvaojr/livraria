<?php

namespace App\Services;

interface ServiceInterface
{
    public function salvar(array $dados): object;
    public function alterar(array $dados, int $id): int;
    public function recuperar(int $id): object;
    public function remover(int $id): bool;
}
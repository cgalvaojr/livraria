<?php

use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $ddl = <<<DDL
            SELECT
                a."Nome" AS Autor,
                l."Titulo",
                l."Edicao",
                l."AnoPublicacao",
                l."Editora",
                l."Valor",
                (
                    SELECT STRING_AGG(assu."Descricao", ', ')
                    FROM "Assunto" assu
                    INNER JOIN "Livro_Assunto" lassu ON lassu."Assunto_codAs" = assu."CodAs"
                    WHERE lassu."Livro_Codl" = l."Codl"
                ) AS Assuntos
            FROM "Autor" a
                     INNER JOIN "Livro_Autor" la ON la."Autor_CodAu" = a."CodAu"
                     INNER JOIN "Livro" l ON la."Livro_Codl" = l."Codl"
                     INNER JOIN "Livro_Assunto" lass ON lass."Livro_Codl" = l."Codl"
                     INNER JOIN "Assunto" ass ON ass."CodAs" = lass."Assunto_codAs";
DDL;

//        $query = DB::raw($ddl);
        Schema::createView('Reports', $ddl);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropView('Reports');

    }
};

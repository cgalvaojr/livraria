<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Livro_Autor', function(Blueprint $table) {

            $table->integer('Livro_Codl')->foreign('Livro_Codl', 'Livro_Autor_FKIndex1')->references('Codl')->on('Livro');
            $table->integer('Autor_CodAu')->foreign('Autor_CodAu', 'Livro_Autor_FKIndex2')->references('CodAu')->on('Autor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('Livro_Autor');
    }
};

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
        $query = DB::table('Livro');
        Schema::createView('Reports', $query);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropView('Reports');

    }
};

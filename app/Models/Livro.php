<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro extends Model
{
    protected $table = 'Livro';
    protected $primaryKey = 'Codl';
    public $timestamps = false;
    protected $fillable = ['Titulo', 'Editora', 'Edicao', 'AnoPublicacao', 'Valor'];

    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_codAs' );
    }
    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }
}

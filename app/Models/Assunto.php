<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $table = 'Assunto';
    protected $primaryKey = 'CodAs';
    public $timestamps = false;
    protected $fillable = ['Descricao'];

    public function livro()
    {
        return $this->belongsTo(Livro_Assunto::class, 'CodAs', 'Assunto_codAs');
    }
}

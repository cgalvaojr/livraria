<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro_Assunto extends Model
{
    protected $table = 'Livro_Assunto';
    public $timestamps = false;

    public $primaryKey = 'Livro_Codl';
    protected $fillable = ['Livro_Codl', 'Assunto_codAs'];
}

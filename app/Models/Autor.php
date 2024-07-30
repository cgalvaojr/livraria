<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'Autor';
    protected $primaryKey = 'CodAu';
    public $timestamps = false;
    protected $fillable = ['Nome'];

    public function livro(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Livro_Autor::class, 'CodAu', 'Autor_CodAu');
    }
}

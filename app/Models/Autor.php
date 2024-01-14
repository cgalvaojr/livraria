<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'Autor';
    protected $primaryKey = 'CodAu';
    public $timestamps = false;

//$flights = Flight::where('active', 1)
//->orderBy('name')
//->take(10)
//->get();
}

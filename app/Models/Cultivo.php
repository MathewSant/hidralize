<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultivo extends Model
{
    use HasFactory;

    protected $fillable = ['nome_cultura', 'area_cultivo', 'metodo_irrigacao'];

    public function consumos()
    {
        return $this->hasMany(ConsumoAgua::class);
    }
}

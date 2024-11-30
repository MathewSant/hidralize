<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumoAgua extends Model
{
    use HasFactory;

    protected $fillable = [
        'cultivo_id',
        'data',
        'volume_utilizado',
        'estagio_cultura', // Adicione este campo
        'temperatura',
        'precipitacao',
    ];

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }
}

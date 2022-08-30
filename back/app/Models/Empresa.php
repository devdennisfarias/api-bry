<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'endereco',
        'cliente_id',
        'funcionario_id',
    ];


    public function funcionario(): BelongsToMany
    {
        return $this->belongsToMany(Funcionario::class);
    }

    public function cliente(): BelongsToMany
    {
        return $this->belongsToMany(Cliente::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'endereco',
        'documento',
        'cliente_id',
        'funcionario_id',
    ];


    public function funcionarios(): HasMany
    {
        return $this->hasMany(Funcionario::class);
    }

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }

}

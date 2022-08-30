<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'nome',
        'cpf',
        'email',
        'endereco',
        'senha',
        'empresa_id'
    ];

    public function empresas(): BelongsToMany
    {
        return $this->belongsToMany(Empresa::class);
    }
}

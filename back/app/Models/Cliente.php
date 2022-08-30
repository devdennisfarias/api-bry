<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
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

    public function empresa(): BelongsToMany
    {
        return $this->belongsToMany(Empresa::class);
    }
}

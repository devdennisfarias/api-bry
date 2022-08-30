<?php

namespace App\Http\Resources;

use App\Services\LinksGenerator;
use Illuminate\Http\Resources\Json\JsonResource;

class FuncionarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $links = new LinksGenerator;
        $links->get(route('funcionarios.show', $this->id), 'funcionario_detalhes');
        $links->put(route('funcionarios.update', $this->id), 'funcionario_atualizar');
        $links->delete(route('funcionarios.destroy', $this->id), 'funcionario_remover');
        return[
            'login' => $this->login,
            'nome' => $this->nome,
            'cpf'=>$this->cpf,
            'email'=>$this->email,
            'endereco'=>$this->endereco,
            'senha' => $this->senha,
            'empresa_id' => $this->whenPivotLoaded('empresa_funcionario', function(){
                return $this->pivot->empresa_id;
            }),
            'links' => $links->toArray()
        ];
    }
}

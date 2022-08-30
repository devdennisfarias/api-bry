<?php

namespace App\Http\Resources;

use App\Services\LinksGenerator;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
        $links->get(route('empresas.show', $this->id), 'empresa_detalhes');
        $links->put(route('empresas.update', $this->id), 'empresa_atualizar');
        $links->delete(route('empresas.destroy', $this->id), 'empresa_remover');

        return [
            'nome' => $this->nome,
            'endereco' => $this->endereco,
            'cnpj' => $this->cnpj,
            'tipo' => $this->tipo,
            'funcionario_id' => $this->whenPivotLoaded('empresa_funcionario', function(){
                return $this->pivot->funcionario_id;
            }),
            'cliente_id' => $this->whenPivotLoaded('empresa_cliente', function(){
                return $this->pivot->cliente_id;
            }),
            
            'links' => $links->toArray()
        ];
    }
}

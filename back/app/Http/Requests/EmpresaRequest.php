<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'string', 'between:4,100'],
            'endereco' => ['required', 'string', 'between:2,100'],
            'tipo' => ['required', 'string', 'between:2,100'],
            'CNPJ' => ['required', 'int', '14'],
            /*            
            'funcionario_id' => ['required', 'int', 'exists:funcionarios,id'],
            'cliente_id' => ['required', 'int', 'exists:clientes,id'], 
            */
        ];
    }
}

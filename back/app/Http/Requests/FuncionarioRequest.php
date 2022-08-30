<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
            'login' => ['required', 'string', 'between:2,100'],
            'nome' => ['required', 'string', 'between:2,100'],
            'cpf' => ['required', 'int', '11'],
            'email' => ['required', 'email'],
            'endereco' => ['required', 'string', 'between:2,100'],
            'senha' => ['required', 'password'],
            'empresa_id' => ['required', 'int','exists:funcionario,id'],
        ];
    }
}

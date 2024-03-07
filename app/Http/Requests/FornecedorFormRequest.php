<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FornecedorFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:3|max:40',
            'site' => 'required',
            'uf' => 'required|min:2|max:2',
            'email' => 'email'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchida',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
            'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
            'email.email' => 'O campo e-mail não foi preenchido corretamente'
        ];
    }

    protected function failedValidation(Validator $validator) {
    // Certifique-se de que não há lógica de redirecionamento aqui.
    parent::failedValidation($validator);
}
}

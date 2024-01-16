<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Livro extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Titulo' => 'required|max:40',
            'Editora' => 'required|max:40',
            'Edicao' => 'required|integer',
            'AnoPublicacao' => 'required|integer|min:1900|max:' . (date('Y')+1),
            'Valor' => 'required|min:1',
            'Autor' => 'required',
            'Assunto' => 'required'
        ];
    }
}

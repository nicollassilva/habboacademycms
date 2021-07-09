<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTopicComment extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'active' => ['required', 'boolean'],
            'moderated' => ['required', 'in:pending,moderated']
        ];
    }

    public function messages()
    {
        return [
            'active.required' => 'Campo "active" não está presente no formulário',
            'active.boolean' => 'Valor inválido no campo "active"',
            'moderated.required' => 'Campo "moderado" não está presente no formulário',
            'moderated.in' => 'Valor inválido no campo "moderado"',
        ];
    }
}

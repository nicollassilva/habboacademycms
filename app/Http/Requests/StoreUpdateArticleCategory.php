<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateArticleCategory extends FormRequest
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
        return  [
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'icon' => ['nullable', 'image']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Digite o nome da categoria',
            'name.string' => 'Digite o nome da categoria',
            'name.min' => 'O campo nome precisa ter no mínimo 6 caracteres',
            'name.max' => 'O campo nome precisa ter no máximo 255 caracteres',
            'icon.image' => 'O campo ícone precisa ser do tipo imagem',
        ];
    }
}

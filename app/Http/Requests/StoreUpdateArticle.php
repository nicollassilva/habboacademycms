<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateArticle extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'min:6', 'max:255'],
            'description' => ['required', 'string', 'min:6', 'max:255'],
            'category' => ['required', 'numeric', 'exists:articles_categories,id'],
            'image' => ['required', 'image'],
            'content' => ['required', 'min:10']
        ];

        if($this->isMethod('PUT')) {
            $rules['image'] = ['nullable', 'image'];
            $rules['status'] = ['required', 'boolean'];
            $rules['fixed'] = ['required', 'boolean'];
            $rules['reviewed'] = ['required', 'boolean'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Digite um título',
            'title.min' => 'Digite um título',
            'title.max' => 'Título muito grande, faça um menor',
            'description.required' => 'Digite uma descrição',
            'description.min' => 'Digite uma descrição',
            'description.max' => 'Descrição muito grande, faça uma menor',
            'category.required' => 'Informe a categoria',
            'category.numeric' => 'Informe a categoria',
            'category.exists' => 'Categoria não existe',
            'image.required' => 'Insira a imagem',
            'image.image' => 'Insira uma imagem válida',
            'content.required' => 'Digite sua notícia',
            'content.min' => 'Digite seu notícia',
            'status.required' => 'Informe o status da notícia',
            'status.boolean' => 'Informe o status da notícia',
            'fixed.required' => 'Informe o campo "fixa"',
            'fixed.boolean' => 'Informe o campo "fixa"',
            'reviewed.required' => 'Informe o campo "revisada"',
            'reviewed.boolean' => 'Informe o campo "revisada"',
        ];
    }
}

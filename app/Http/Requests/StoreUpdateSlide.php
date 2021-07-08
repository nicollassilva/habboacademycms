<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSlide extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image'],
            'new_tab' => ['required', 'boolean']
        ];

        if($this->isMethod('PUT')) {
            $rules['image'] = ['nullable', 'image'];
            $rules['active'] = ['required', 'boolean'];
            $rules['fixed'] = ['required', 'boolean'];
        }

        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPostRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:100|max:99999999'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do produto é obrigatório',
            'name.min' => 'O nome do produto deve ter 3 ou mais caracteres',
            'name.max' => 'O nome do produto deve ter no máximo 255 caracteres',

            'description.required' => 'A descrição do produto é obrigatória',
            'description.min' => 'A descrição do produto deve ter 3 ou mais caracteres',
            'description.max' => 'A descrição do produto deve ter no máximo 255 caracteres',

            'price.required' => 'O preço do produto é obrigatório',
            'price.numeric' => 'O preço do produto deve ser do tipo numérico',
            'price.min' => 'O preço do produto deve ser no mínimo 100',
            'price.max' => 'O preço do produto deve ser no máximo 99999999',
        ];
    }
}

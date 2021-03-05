<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalePostRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'cpf' => 'required|integer|regex:/(\d{11})/',
            'quantity' => 'required|integer|min:1|max:10',
            'discount' => 'required|numeric|min:0|max:100',
            'date' => 'required',
            'product_id' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do cliente é obrigatório',
            'name.min' => 'O nome do cliente deve ter 3 ou mais caracteres',
            'name.max' => 'O nome do cliente deve ter no máximo 255 caracteres',

            'email.required' => 'O email é obrigatório',
            'email.email' => 'Informe um email com formato válido',
            'email.max' => 'O email deve ter no máximo 255 caracteres',

            'cpf.required' => 'O cpf é obrigatório',
            'cpf.integer' => 'Informe apenas os números do cpf',
            'cpf.regex' => 'O cpf deve ter 11 números',

            'quantity.required' => 'A quantidade de produtos é obrigatória',
            'quantity.integer' => 'Informe apenas números',
            'quantity.min' => 'A quantidade de produtos deve ser de 1 a 10',
            'quantity.max' => 'A quantidade de produtos deve ser de 1 a 10',

            'discount.required' => 'O desconto é obrigatório',
            'discount.numeric' => 'Informe apenas números',
            'discount.min' => 'O desconto deve ser de 0 a 100',
            'discount.max' => 'O desconto deve ser de 0 a 100',

            'date.required' => 'A data é obrigatória',

            'product_id.required' => 'O produto é obrigatório',

            'status.required' => 'O status é obrigatório',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'max:255',
            'stock' => 'required|numeric',
            'delivery_days' => 'required|numeric',
            'image' => 'image',
            'amount' => 'required|max:255'
        ];

        if (($this->request->get('product_id'))) {
            $rules['product_id'] = 'required|int|exists:products,id';
        }

        if (!($this->request->get('product_id'))) {
            $rules['reference'] = 'required|unique:products|max:255';
        }
        
        return $rules;
    }
}

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:255|unique:products',
            'description'=>'required|max:255',
            'price'=> 'required|max:100',
            'stock'=> 'required|max:6',
            'discount'=> 'required|max:2',
            'category_id'=> 'required|exists:App\Models\ProductCategory,id',
            'user_id'=>'required|exists:App\Models\User,id'

        ];
    }
}

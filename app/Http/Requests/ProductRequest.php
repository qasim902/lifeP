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
            'price' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'id' => 'nullable|exists:products,id',
            'name'=> 'required|string',
            'description'=> 'nullable|string'
        ];
    }
}

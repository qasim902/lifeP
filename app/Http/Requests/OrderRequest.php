<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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

    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
//            'price' => 'required|numeric',
//            'tax' => 'required|numeric',
//            'total' => 'required|numeric',
//            'user_id' => 'required|exists:users,id',
//            'id' => 'nullable|exists:orders,id'
        ];
    }
}

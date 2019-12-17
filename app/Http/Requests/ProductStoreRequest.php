<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   ProductStoreRequest extends FormRequest
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
            'name' => 'required|min:4',
            'stock' => 'required',
            'capital' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'nama produk tidak boleh kosong',
            'stock.required' => 'stok tidak boleh kosong',
            'capital.required' => 'modal tidak boleh kosong',

            'name.min' => 'nama produk minimal 4 karakter'
        ];
    }

}

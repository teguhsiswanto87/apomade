<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'nama lengkap tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',

            'name.min' => 'nama lengkap minimal 3 karakter',
            'email.email' => 'email tidak valid'
        ];
    }

}

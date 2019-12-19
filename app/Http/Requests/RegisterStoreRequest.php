<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'nama lengkap tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
            'confirmation.required' => 'confirmation password tidak boleh kosong',

            'name.min' => 'nama lengkap minimal 3 karakter',
            'email.email' => 'email tidak valid',
            'email.unique' => 'email sudah terdaftar',
            'password.min' => 'password minimal 4 karakter',
            'confirmation.same' => 'confirmation password tidak sama'

        ];
    }

}

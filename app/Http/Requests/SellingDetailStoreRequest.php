<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellingDetailStoreRequest extends FormRequest
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
//            'sellings_id[]' => 'required',
//            'products_id[]' => 'required',
//            'capital' => 'required',
//            'selling_price' => 'required',
//            'qty' => 'required'
        ];
    }

    public function message()
    {
        return [
//            'sellings_id.required' => 'ID Penjualan tidak bolah kosong',
//            'products_id.required' => 'ID Produk tidak bolah kosong',
//            'capital.required' => 'Modal tidak bolah kosong',
//            'selling_price.required' => 'Harga Jual tidak bolah kosong',
//            'qty.required' => 'Jumlah beli tidak bolah kosong'
        ];
    }

}

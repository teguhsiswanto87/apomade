<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellingStoreRequest extends FormRequest
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
            'market_places_id' => 'required',
            'couriers_id' => 'required',
            'purchase_date' => 'required',
            'buyers_name' => 'required',
//            'turnover' => 'required',
//            'profit' => 'required',
            'selling_status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'market_places_id.required' => 'Sumber Transaksi tidak boleh kosong',
            'couriers_id.required' => 'Jasa Pengiriman tidak boleh kosong',
            'purchase_date.required' => 'tanggal pembelian tidak boleh kosong',
            'buyers_name.required' => 'nama pembeli tidak boleh kosong',
//            'turnover.required' => 'omzet tidak boleh kosong',
//            'profit.required' => 'untung tidak boleh kosong',
            'selling_status.required' => 'pilih status transaksi'
        ];
    }


}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email:dns',
            'telp_numb' => 'required|numeric|digits_between:8,15',
            'whatsapp' => 'required|numeric|digits_between:8,15',
            'instagram' => 'required',
            'address' => 'required',
            'family_number1' => 'required|numeric|digits_between:8,15',
            'family_number2' => 'required|numeric|digits_between:8,15',
            'post_code' => 'required|numeric',
            'KTP_pict' => 'required|image|max:2048',
            'KTP_selfie' => 'required|image|max:2048',
            'payment_pict' => 'required|image|max:2048',
            'costume_id' => 'required',
            'rent_date' => 'required',
            'ship_date' => 'required',
            'DP' => 'required|numeric|min:50000',

        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute Harus angka',
            'email' => 'format email salah',
            'digits_between' => ':attribute minimal :min digit maksimal :max digit',
            'KTP_pict.max' => 'size :attribute maksmial 2 MB',
            'KTP_selfie.max' => 'size :attribute maksmial 2 MB',
            'payment_pict.max' => 'size :attribute maksmial 2 MB',
            'DP.size' => ':attribute minimal 50000',

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nama',
            'telp_numb' => 'no telepon',
            'address' => 'alamat',
            'family_number1' => 'no telepon kerabat 1',
            'family_number2' => 'no telepon kerabat 2',
            'post_code' => 'kode pos',
            'KTP_pict' => 'foto KTP',
            'KTP_selfie' => 'foto selfie KTP',
            'payment_pict' => 'bukti pembayaran',
            'rent_date' => 'tanggal rental',
            'ship_date' => 'tanggal pengiriman',
            'DP' => 'DP',
            'costume_id' => 'kostum'
        ];
    }
}

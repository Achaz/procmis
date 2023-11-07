<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'email' => 'required|email',
            'user_id' => 'nullable',
            'suppliername' => 'required|string',
            'supplierphone'  => 'required|string',
            'supplieraddress' => 'nullable',
            'suppliercity'  => 'required|string',
            'supplierstate'  => 'nullable',
            'supplierzip'  => 'nullable',
            'suppliercountry'  => 'required|string',
            
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'Invitation with this supplier email address has already requested.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:tenants,id',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'token' => 'required|string|max:40|exists:invitations,invitation_token'
        ];
    }
}

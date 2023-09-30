<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvitationRequest extends FormRequest
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
            'email' => 'required|email|unique:invitations',
            'user_id' => 'nullable'
        ];
    }

    public function prepareForValidation()
    {
      return $this->merge([
        'user_id' => $this->user()?->id
      ]);
    }

  /**
     * Custom error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'Invitation with this email address already requested.'
        ];
    }
}

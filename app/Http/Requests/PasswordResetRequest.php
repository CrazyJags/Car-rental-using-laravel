<?php

namespace App\Http\Requests;

/**
 * Class PasswordResetRequest
 * Request data for password reset
 * @package App\Http\Requests
 */
class PasswordResetRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => 'required|confirmed|min:6',
            'code'     => 'required'
        ];
    }
}

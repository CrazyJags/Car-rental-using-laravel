<?php

namespace App\Http\Requests;

/**
 * Class ForgotPasswordRequest
 * Data for the forgot password process
 * @package App\Http\Requests
 */
class ForgotPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'email|required|exists:users,email'
        ];
    }
}

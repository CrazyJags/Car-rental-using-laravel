<?php

namespace App\Http\Requests;

/**
 * Class LoginRequest
 * Data for users login
 * @package App\Http\Requests
 */
class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string|min:6'
        ];
    }
}

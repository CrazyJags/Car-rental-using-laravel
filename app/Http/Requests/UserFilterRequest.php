<?php

namespace App\Http\Requests;

use App\Models\User;

/**
 * Class UserFilterRequest
 * Request query params for User filtering
 * @package App\Http\Requests
 */
class UserFilterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'              => 'string|nullable',
            'email'             => 'string|nullable',
            'role'              => 'nullable|in:' . implode(',', User::ROLES),
            'registered_before' => 'date|nullable',
            'registered_after'  => 'date|nullable',
            'page'              => 'integer|numeric|min:|nullable',
            'perPage'           => 'integer|numeric|min:0|nullable'
        ];
    }
}

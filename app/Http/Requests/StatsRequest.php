<?php

namespace App\Http\Requests;

/**
 * Class StatsRequest
 * Request to
 * @package App\Http\Requests
 */
class StatsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'since' => 'integer|numeric'
        ];
    }
}

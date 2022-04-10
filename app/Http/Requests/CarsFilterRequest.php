<?php

namespace App\Http\Requests;

/**
 * Class CarsFilterRequest
 * Get request for filtering cars
 * @package App\Http\Requests
 */
class CarsFilterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'page'    => 'integer|numeric|nullable',
            'perPage' => 'integer|numeric|nullable',
            'model'   => 'string|nullable',
            'brand'   => 'string|nullable',
            'color'   => 'string|nullable',
            'year'    => 'integer|min:1950|max:2030|nullable'
        ];
    }
}

<?php

namespace App\Http\Requests;

/**
 * Class CarsRequest
 * Request data for Cars creation/update
 * @package App\Http\Requests
 */
class CarRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'model'       => 'string|required',
            'brand'       => 'string|required',
            'color'       => 'string|required',
            'year'        => 'required|integer|min:1900|max:2050',
            'description' => 'string|required',
            'hourly_rate' => 'numeric|min:0|required',
            'images.*'    => 'image|max:2048'
        ];
    }
}

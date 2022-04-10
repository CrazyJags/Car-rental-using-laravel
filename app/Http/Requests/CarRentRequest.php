<?php

namespace App\Http\Requests;

/**
 * Class CarRentRequest
 * Query data for rent availability checking/Renting cars
 * @package App\Http\Requests
 */
class CarRentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start_date' => 'date|required',
            'end_date'   => 'date|required|after:start_date'
        ];
    }
}

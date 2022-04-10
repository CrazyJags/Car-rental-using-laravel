<?php

namespace App\Http\Requests;

/**
 * Class CarLocationsFilterRequest
 * Data for filtering car rents
 * @package App\Http\Requests
 */
class CarRentsFilterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start_date_after'  => 'date|nullable',
            'start_date_before' => 'date|nullable',
            'end_date_after'    => 'date|nullable',
            'end_date_before'   => 'date|nullable',
            'page'              => 'integer|numeric|min:0|nullable',
            'perPage'           => 'integer|numeric|min:0|nullable'
        ];
    }
}

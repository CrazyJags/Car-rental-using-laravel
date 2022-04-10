<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CarImagesRequest
 * Request for creation of a car image
 * @package App\Http\Requests
 */
class CarImagesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'image' => 'image|required|max:2048'
        ];
    }
}

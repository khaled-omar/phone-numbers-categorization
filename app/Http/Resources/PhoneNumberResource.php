<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PhoneNumberResource
 *
 * @package App\Http\Resources
 */
class PhoneNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Country' => $this->country,
            'State' => $this->state ? 'OK' : 'NOK',
            'CountryCode' => $this->country_code,
            'Phone' => $this->phone_number,
        ];
    }
}

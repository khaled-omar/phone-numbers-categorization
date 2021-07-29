<?php

namespace App\Utilities;

/**
 * Class PhoneNumberParser
 *
 * @package App\Utilities
 */
class PhoneNumberParser
{
    /**
     * @var string $phoneNumber
     */
    protected $phoneNumber;

    /**
     * @var int $countryCode
     */
    protected $countryCode;

    /**
     * Parse the phone to country code and phone.
     *
     * @param $phoneNumber
     */
    public function parse($phoneNumber)
    {
        $splits = explode(' ', $phoneNumber);;
        $this->countryCode = str_replace(['(', ')'], '', $splits[0]);
        $this->phoneNumber = $splits[1];
    }

    /**
     * Return phone number
     *
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Return country code
     *
     * @return mixed
     */

    public function getCountryCode()
    {
        return $this->countryCode;
    }
}

<?php

namespace App\Utilities;

use \Exception;

/**
 * Class PhoneNumberValidator
 *
 * @package App\Utilities
 */
class PhoneNumberValidator
{
    /**
     * Return the validation state of phone number against a regex.
     *
     * @param $phone
     * @param $countryCode
     * @return string
     * @throws \Exception
     */
    public function isValid($phone, $countryCode)
    {
        $regex = $this->getCountryRegex($countryCode);

        return $this->validate($phone, $regex);
    }

    /**
     * Get the mapping regular expression by country code.
     *
     * @param $countryCode
     * @return mixed
     * @throws \Exception
     */
    protected function getCountryRegex($countryCode)
    {
        $countriesCollection = collect(config('phone_numbers.countries'));
        $countryRecord = $countriesCollection->firstWhere('code', '=', $countryCode);

        if (blank($countryRecord)) {
            throw new Exception("Invalid county code provided {$countryCode}");
        }

        return $countryRecord['regex'];
    }

    /**
     * Validate a phone number against regular expression.
     *
     * @param $phone
     * @param $regex
     * @return string
     */
    protected function validate($phone, $regex)
    {
        $regex = '/'.$regex.'/i';

        return preg_match($regex, $phone);
    }
}

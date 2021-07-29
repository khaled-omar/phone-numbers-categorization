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
     * Return the validation state of phone number.
     *
     * @param $phoneNumberRecord
     * @return string
     * @throws \Exception
     */
    public static function isValid($phoneNumberRecord)
    {
        $regex = self::getCountryRegex($phoneNumberRecord->country_code);

        return self::validate($phoneNumberRecord->phone, $regex);
    }

    /**
     * Get the mapping regular expression by country code.
     *
     * @param $countryCode
     * @return mixed
     * @throws \Exception
     */
    protected static function getCountryRegex($countryCode)
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
    protected static function validate($phone, $regex)
    {
        $regex = '/'.$regex.'/i';

        return preg_match($regex, $phone);
    }
}

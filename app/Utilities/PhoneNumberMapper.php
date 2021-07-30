<?php

namespace App\Utilities;

use App\Services\CountryService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class PhoneNumberMapper
 *
 * @package App\Utilities
 */
class PhoneNumberMapper
{
    /**
     * @var \App\Utilities\PhoneNumberParser
     */
    protected $phoneNumberParser;

    /**
     * @var \App\Services\CountryService
     */
    protected $countryService;

    /**
     * @var \App\Utilities\PhoneNumberValidator
     */
    protected $phoneNumberValidator;

    /**
     * PhoneNumberMapper constructor.
     *
     * @param \App\Utilities\PhoneNumberParser $phoneNumberParser
     * @param \App\Services\CountryService $countryService
     * @param \App\Utilities\PhoneNumberValidator $phoneNumberValidator
     */
    public function __construct(
        PhoneNumberParser $phoneNumberParser,
        CountryService $countryService,
        PhoneNumberValidator $phoneNumberValidator
    ) {
        $this->phoneNumberParser = $phoneNumberParser;
        $this->countryService = $countryService;
        $this->phoneNumberValidator = $phoneNumberValidator;
    }

    /**
     * Map all phone numbers records to phone, county code, state and country.
     *
     * @param Collection $phoneNumbersRecords
     */
    public function map(Collection &$phoneNumbersRecords)
    {
        // Cache the mapped phone number records to save processing time for subsequent requests on retrieved customers from database.
        // @NOTE: In case of add/update/delete or even regex changes, we should flush the cache for the below key.
        $phoneNumbersRecords =  Cache::remember('mapped-phone-numbers', 60 * 60 * 24, function () use ($phoneNumbersRecords){
            $phoneNumbersRecords->map(function ($phoneNumberRecord) {
                $this->parsePhoneNumber($phoneNumberRecord);
                $this->mapCodeIntoCountry($phoneNumberRecord);
                $this->validatePhoneNumber($phoneNumberRecord);
            });

            return $phoneNumbersRecords;
        });

    }

    /**
     * Parse phone number to phone and country code.
     *
     * @param $phoneNumberRecord
     */
    protected function parsePhoneNumber($phoneNumberRecord)
    {
        $this->phoneNumberParser->parse($phoneNumberRecord->phone);
        $phoneNumberRecord->phone_number = $this->phoneNumberParser->getPhoneNumber();
        $phoneNumberRecord->country_code = $this->phoneNumberParser->getCountryCode();
    }

    /**
     * Map the phone number code to county.
     *
     * @param $phoneNumberRecord
     */
    protected function mapCodeIntoCountry($phoneNumberRecord)
    {
        $phoneNumberRecord->country = $this->countryService->getCountry($phoneNumberRecord->country_code)['name'];
    }

    /**
     * Validate phone number against a regex.
     *
     * @param $phoneNumberRecord
     * @throws \Exception
     */
    protected function validatePhoneNumber($phoneNumberRecord)
    {
        $phoneNumberRecord->state = $this->phoneNumberValidator->isValid($phoneNumberRecord->phone, $phoneNumberRecord->country_code);
    }
}

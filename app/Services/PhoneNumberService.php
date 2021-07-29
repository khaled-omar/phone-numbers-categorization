<?php

namespace App\Services;

use App\Repositories\PhoneNumberRepository;
use App\Utilities\PhoneNumberParser;
use App\Utilities\PhoneNumberValidator;
use \Illuminate\Support\Collection;

/**
 * Class PhoneNumberService
 *
 * @package App\Services
 */
class PhoneNumberService
{
    /**
     * @var \App\Repositories\PhoneNumberRepository
     */
    protected $repository;

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
     * PhoneNumberService constructor.
     *
     * @param \App\Repositories\PhoneNumberRepository $repository
     * @param \App\Utilities\PhoneNumberParser $phoneNumberParser
     * @param \App\Services\CountryService $countryService
     * @param \App\Utilities\PhoneNumberValidator $phoneNumberValidator
     */
    public function __construct(
        PhoneNumberRepository $repository,
        PhoneNumberParser $phoneNumberParser,
        CountryService $countryService,
        PhoneNumberValidator $phoneNumberValidator
    ) {
        $this->repository = $repository;
        $this->phoneNumberParser = $phoneNumberParser;
        $this->countryService = $countryService;
        $this->phoneNumberValidator = $phoneNumberValidator;
    }

    /**
     * Return phone numbers search results.
     *
     * @param array $filters
     * @return \Illuminate\Support\Collection
     */
    public function search(array $filters = [])
    {
        $phoneNumbersRecords = $this->repository->getAll();
        $this->mapPhoneNumbers($phoneNumbersRecords);
        $this->filterPhoneNumbers($phoneNumbersRecords, $filters);

        return $phoneNumbersRecords;
    }

    /**
     * Map all phone numbers records to phone, county code, state and country.
     *
     * @param Collection $phoneNumbersRecords
     */
    protected function mapPhoneNumbers(Collection $phoneNumbersRecords)
    {
        $phoneNumbersRecords->map(function ($phoneNumberRecord) {
            $this->parsePhoneNumber($phoneNumberRecord->phone);
            $this->mapPhoneNumberCountry($phoneNumberRecord);
            $this->validatePhoneNumber($phoneNumberRecord);
        });
    }

    /**
     * Parse phone number to phone and country code.
     *
     * @param $phone
     */
    protected function parsePhoneNumber($phone)
    {
        $this->phoneNumberParser->parse($phone);
    }

    /**
     * Map the phone number to county and country code.
     *
     * @param $phoneNumberRecord
     */
    protected function mapPhoneNumberCountry($phoneNumberRecord)
    {
        $phoneNumberRecord->phone_number = $this->phoneNumberParser->getPhoneNumber();
        $phoneNumberRecord->country_code = $this->phoneNumberParser->getCountryCode();
        $phoneNumberRecord->country = $this->countryService->getCountry($phoneNumberRecord->country_code)['name'];
    }

    /**
     * Validate phone number.
     *
     * @param $phoneNumberRecord
     * @throws \Exception
     */
    protected function validatePhoneNumber($phoneNumberRecord)
    {
        $phoneNumberRecord->state = $this->phoneNumberValidator->isValid($phoneNumberRecord->phone, $phoneNumberRecord->country_code);
    }

    /**
     * Apply provided filters on retrieved phone numbers.
     *
     * @param \Illuminate\Support\Collection $phoneNumbersRecords
     * @param array $filters
     * @return \Illuminate\Support\Collection
     */
    protected function filterPhoneNumbers(Collection &$phoneNumbersRecords, array $filters)
    {
        if (array_key_exists('country_code_filter', $filters) && filled($filters['country_code_filter'])) {

            $phoneNumbersRecords = $phoneNumbersRecords->where('country_code', '=', $filters['country_code_filter']);
        }
        if (array_key_exists('state_filter', $filters) && filled($filters['state_filter'])) {
            $phoneNumbersRecords = $phoneNumbersRecords->where('state', '=', $filters['state_filter']);
        }

        return $phoneNumbersRecords;
    }
}

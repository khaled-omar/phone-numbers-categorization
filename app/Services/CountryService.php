<?php

namespace App\Services;

use App\Repositories\CountryRepository;

/**
 * Class CountryService
 *
 * @package App\Services
 */
class CountryService
{
    /**
     * @var \App\Repositories\CountryRepository
     */
    protected $countryRepository;

    /**
     * CountryService constructor.
     *
     * @param \App\Repositories\CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Get country by country code.
     *
     * @param $countryCode
     * @return mixed
     */
    public function getCountry($countryCode)
    {
        return $this->countryRepository->getByCode($countryCode);
    }
}

<?php

namespace App\Repositories;

/**
 * Class CountryRepository
 *
 * @package App\Repositories
 */
class CountryRepository
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $countriesCollection;

    /**
     * CountryRepository constructor.
     */
    public function __construct()
    {
        // This should retrieve a list of countries
        // From a persistent storage for ex: database or json file
        // But for now we will return a static config array.
        $this->countriesCollection = collect(config('phone_numbers.countries'));
    }

    public function getAll()
    {

        return $this->countriesCollection;
    }

    public function getByCode($code)
    {
        return $this->countriesCollection->firstWhere('code', '=', $code);
    }
}

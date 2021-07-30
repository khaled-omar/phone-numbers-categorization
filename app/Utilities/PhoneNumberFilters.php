<?php

namespace App\Utilities;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class PhoneNumberFilters
 *
 * @package App\Utilities
 */
class PhoneNumberFilters
{
    /**
     * Apply provided filters on retrieved phone numbers.
     *
     * @param $filters
     * @param \Illuminate\Support\Collection $phoneNumbersRecords
     */
    public function applyFilters($filters, Collection &$phoneNumbersRecords)
    {
        collect($filters)->each(function ($value, $filterName) use (&$phoneNumbersRecords) {
            $methodName = 'apply'.Str::studly($filterName);
            if (method_exists($this, $methodName)) {
                $this->{$methodName}($phoneNumbersRecords, $value);
            }
        });
    }

    /**
     * Filter by country code.
     *
     * @param \Illuminate\Support\Collection $phoneNumbersRecords
     * @param $value
     */
    protected function applyCountryCodeFilter(Collection &$phoneNumbersRecords, $value)
    {
        $phoneNumbersRecords = $phoneNumbersRecords->where('country_code', '=', $value);
    }

    /**
     * Filter by state.
     *
     * @param \Illuminate\Support\Collection $phoneNumbersRecords
     * @param $value
     */
    protected function applyStateFilter(Collection &$phoneNumbersRecords, $value)
    {
        $phoneNumbersRecords = $phoneNumbersRecords->where('state', '=', $value);
    }
}

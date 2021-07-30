<?php

namespace App\Utilities;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class PhoneNumberPaginator
 *
 * @package App\Utilities
 */
class PhoneNumberPaginator
{
    /**
     * Return a paginated results.
     *
     * @param \Illuminate\Support\Collection $phoneNumbersRecords
     * @param int $page
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(Collection $phoneNumbersRecords, $page = 1, $limit = 10)
    {
        $pageIndex = $page - 1;
        $paginatedPhoneNumbers = $phoneNumbersRecords->skip($pageIndex * $limit)->take($limit);

        return new LengthAwarePaginator($paginatedPhoneNumbers, $phoneNumbersRecords->count(), $limit, $page);
    }
}

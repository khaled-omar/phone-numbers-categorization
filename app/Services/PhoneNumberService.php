<?php

namespace App\Services;

use App\Repositories\PhoneNumberRepository;
use App\Utilities\PhoneNumberFilters;
use App\Utilities\PhoneNumberMapper;
use App\Utilities\PhoneNumberPaginator;

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
    protected $phoneNumberRepository;

    /**
     * @var \App\Utilities\PhoneNumberFilters
     */
    protected $phoneNumberFilter;

    /**
     * @var \App\Utilities\PhoneNumberMapper
     */
    protected $phoneNumberMapper;

    /**
     * @var \App\Utilities\PhoneNumberPaginator
     */
    protected $phoneNumberPaginator;

    /**
     * PhoneNumberService constructor.
     *
     * @param \App\Repositories\PhoneNumberRepository $phoneNumberRepository
     * @param \App\Utilities\PhoneNumberFilters $phoneNumberFilter
     * @param \App\Utilities\PhoneNumberMapper $phoneNumberMapper
     * @param \App\Utilities\PhoneNumberPaginator $phoneNumberPaginator
     */
    public function __construct(
        PhoneNumberRepository $phoneNumberRepository,
        PhoneNumberFilters $phoneNumberFilter,
        PhoneNumberMapper $phoneNumberMapper,
        PhoneNumberPaginator $phoneNumberPaginator
    ) {
        $this->phoneNumberRepository = $phoneNumberRepository;
        $this->phoneNumberFilter = $phoneNumberFilter;
        $this->phoneNumberMapper = $phoneNumberMapper;
        $this->phoneNumberPaginator = $phoneNumberPaginator;
    }

    /**
     * Return phone numbers search results.
     *
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [])
    {
        $phoneNumbersRecords = $this->phoneNumberRepository->getAll();
        $this->phoneNumberMapper->map($phoneNumbersRecords);
        $this->phoneNumberFilter->applyFilters($filters, $phoneNumbersRecords);
        $paginatedResults = $this->phoneNumberPaginator->paginate($phoneNumbersRecords, $filters['page'] ?? 1, $filters['limit'] ?? 10);

        return $paginatedResults;
    }
}

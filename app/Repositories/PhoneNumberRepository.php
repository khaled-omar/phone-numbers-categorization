<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class PhoneNumberRepository
 *
 * @package App\Repositories
 */
class PhoneNumberRepository
{
    /**
     * Retrieve all phone numbers from database.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return DB::table('customer')->get(['phone']);
    }
}

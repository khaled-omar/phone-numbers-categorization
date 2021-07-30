<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhoneNumberControllerTest extends TestCase
{
    /**
     * Test search phone numbers service
     *
     * @return void
     */
    public function testSearchPhoneNumbersService()
    {
        $response = $this->get('/api/phone-numbers');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'Country',
                    'State',
                    'CountryCode',
                    'Phone',
                ],
            ]
        ]);
    }

    /**
     * Test filter phone numbers service
     *
     * @return void
     */
    public function testFilterPhoneNumbersService()
    {
        $filters = [
            'country_code_filter' => '258',
            'state_filter' => 1
        ];
        $response = $this->json('GET', '/api/phone-numbers', $filters);

        $response->dump();
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'Country',
                    'State',
                    'CountryCode',
                    'Phone',
                ],
            ]
        ]);
    }
}

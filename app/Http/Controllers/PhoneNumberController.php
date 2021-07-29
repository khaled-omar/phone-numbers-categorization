<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhoneNumberResource;
use App\Http\Resources\PhoneNumberResourceCollection;
use App\Services\PhoneNumberService;
use App\Http\Requests\PhoneNumberRequestValidation as RequestValidation;

class PhoneNumberController extends Controller
{
    /**
     * @var \App\Services\PhoneNumberService
     */
    protected $service;

    /**
     * PhoneNumberController constructor.
     *
     * @param \App\Services\PhoneNumberService $service
     */
    public function __construct(PhoneNumberService $service)
    {
        $this->service = $service;
    }

    /**
     * Retrieve phone numbers with filters.
     *
     * @param \App\Http\Requests\PhoneNumberRequestValidation $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(RequestValidation $request)
    {
        $filters = $request->validated();
        $data = $this->service->search($filters);

        return PhoneNumberResource::collection($data);
    }
}

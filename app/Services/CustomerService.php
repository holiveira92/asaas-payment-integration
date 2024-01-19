<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Http\Resources\CustomerCollection;

class CustomerService
{
    protected CustomerRepository $repository;
    protected AddressService $addressService;

    public function __construct(
        CustomerRepository $repository,
        AddressService $addressService
    )
    {
        $this->repository = $repository;
        $this->addressService = $addressService;
    }

    public function create(array $data)
    {
        $customer = $this->repository->create($data);
        return $customer;
    }

    public function getAll(): CustomerCollection
    {
        $customers = $this->repository->all();
        return new CustomerCollection($customers);
    }

}

<?php

namespace App\Services;

use App\Repositories\AddressRepository;

class AddressService
{
    protected AddressRepository $repository;

    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}

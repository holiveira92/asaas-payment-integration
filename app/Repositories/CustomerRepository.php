<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements RepositoryInterface
{
    protected Customer $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->with("address")->get();
    }

    public function get(int $customerId): Customer
    {
        return $this->model->with("address")->find($customerId);
    }

    public function destroy(int $customerId): void
    {
        DB::transaction(function () use ($customerId) {
            return $this->model->findOrFail($customerId)->delete();
        });
    }

    public function paginated(int $recordsPerPage): array
    {
        return $this->model->paginate($recordsPerPage)->toArray();
    }

    public function create(array $data): Customer
    {
        $customer = DB::transaction(function () use ($data) {
            $model = new Customer();
            $model->id = (string) Str::uuid();
            $model->fill($data);
            $model->save();
            return $model;
        });

        if (!empty($data['address'])) {
            $this->saveAddress($customer, $data['address']);
        }

        return $customer;
    }

    public function persist(int $customerId, array $data): Customer
    {
        $customer = DB::transaction(function () use ($customerId, $data) {
            $model = $this->model->findOrFail($customerId);
            $model->fill($data);
            $model->save();
            return $model;
        });

        return $customer;
    }

    private function saveAddress(Customer $customer, array $addressData): Customer
    {
        $address = $customer->address ?: new Address();
        $address->fill($addressData);
        $address->customer_id = $customer->id;
        $customer->address()->save($address);

        return $customer;
    }
}

<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Support\Facades\DB;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AddressRepository implements RepositoryInterface
{
    protected Address $model;

    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->with("customer")->get();
    }

    public function get(int $addressId): Address
    {
        return $this->model->with("customer")->find($addressId);
    }

    public function destroy(int $addressId): void
    {
        DB::transaction(function () use ($addressId) {
            return $this->model->findOrFail($addressId)->delete();
        });
    }

    public function paginated(int $recordsPerPage): array
    {
        return $this->model->paginate($recordsPerPage)->toArray();
    }

    public function create(array $data): Address
    {
        $address = DB::transaction(function () use ($data) {
            $model = new Address();
            $model->fill($data);
            $model->save();
            return $model;
        });

        return $address;
    }

    public function persist(int $addressId, array $data): Address
    {
        $address = DB::transaction(function () use ($addressId, $data) {
            $model = $this->model->findOrFail($addressId);
            $model->fill($data);
            $model->save();
            return $model;
        });

        return $address;
    }
}

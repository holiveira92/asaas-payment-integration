<?php

namespace App\Repositories;

use App\Models\PaymentHttpTransaction;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository implements RepositoryInterface
{
    protected Payment $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->with([
                'customer',
                'status',
                'method',
                'http_transaction',
            ])->orderBy('created_at', 'DESC')
            ->get();
    }

    public function allByMethod(string $methodName): Collection
    {
        return $this->model->with([
                'customer',
                'status',
                'method',
                'http_transaction',
            ])->whereHas('method', function ($query) use ($methodName){
                return $query->where('slug', $methodName);
            })->orderBy('created_at', 'DESC')
            ->get();
    }

    public function get(int $paymentId): Payment
    {
        return $this->model->with([
            'customer',
            'status',
            'method',
            'http_transaction',
        ])->find($paymentId);
    }

    public function destroy(int $paymentId): void
    {
        DB::transaction(function () use ($paymentId) {
            return $this->model->findOrFail($paymentId)->delete();
        });
    }

    public function paginated(int $recordsPerPage): array
    {
        return $this->model->paginate($recordsPerPage)->toArray();
    }

    public function create(array $data): Payment
    {
        $payment = DB::transaction(function () use ($data) {
            $model = new Payment();
            $model->id = (string) Str::uuid();
            $model->fill($data);
            $model->save();
            return $model;
        });

        if (!empty($data['http_transaction'])) {
            $this->saveHttp($payment, $data, $data['http_transaction']);
        }

        return $payment;
    }

    public function persist(int $paymentId, array $data): Payment
    {
        $payment = DB::transaction(function () use ($paymentId, $data) {
            $model = $this->model->findOrFail($paymentId);
            $model->fill($data);
            $model->save();
            return $model;
        });

        return $payment;
    }

    private function saveHttp(Payment $payment, array $requestData, array $httpTransactionData): Payment
    {
        $httpTransaction = $payment->http_transaction ?: new PaymentHttpTransaction();

        $httpTransaction->payment_id = $payment->id;
        $httpTransaction->client_ip_address = $requestData['client_ip_address'] ?? '';
        $httpTransaction->request = json_encode($requestData);
        $httpTransaction->response = json_encode($httpTransactionData);

        $payment->http_transaction()->save($httpTransaction);

        return $payment;
    }
}

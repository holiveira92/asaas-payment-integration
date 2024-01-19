<?php

namespace App\Services;

use App\Enums\PaymentStatusType;
use App\Repositories\PaymentRepository;
use App\Factory\PaymentGatewayFactory;
use App\Interfaces\PaymentGatewayInterface;
use App\Http\Resources\PaymentResource;
use App\Enums\IntegrationsType;
use App\Http\Resources\PaymentCollection;
use App\Integrations\Asaas\Enums\StatusType;

class PaymentService
{
    protected CustomerService $customerService;
    protected PaymentRepository $repository;
    protected PaymentGatewayInterface $paymentGateway;

    public function __construct(
        CustomerService $customerService,
        PaymentRepository $repository
    )
    {
        $this->paymentGateway = PaymentGatewayFactory::build(IntegrationsType::ASAAS->value);
        $this->customerService = $customerService;
        $this->repository = $repository;
    }

    public function process(array $data): PaymentResource
    {
        $customerApiResponse = $this->paymentGateway->createCustomer($data['customer']);
        $data['customer']['external_id'] = $customerApiResponse['id'] ?? "";
        $data['payment']['order_number'] = generate_order_number($data['customer']['external_id']);

        $customer = $this->customerService->create($data['customer']);
        $paymentApiResponse = $this->paymentGateway->processPayment($data);

        $data['payment'] = $this->buildDefaultData($customer->id ?? "", $data['payment'], $paymentApiResponse);

        $payment = $this->repository->create($data['payment']);

        return new PaymentResource($payment);
    }

    private function buildDefaultData(string $customerId, array $payment, array $apiResponse): array
    {
        $payment['customer_id'] = $customerId;
        $payment['status_id'] = PaymentStatusType::PENDING->value;
        $payment['partner_transaction_id'] = $apiResponse['id'] ?? "";
        $payment['http_transaction'] = $apiResponse;
        $payment['url'] = $apiResponse['bankSlipUrl'] ?? "";
        $payment['qr_code'] = $apiResponse['encodedImage'] ?? "";
        $payment['copia_cola'] = $apiResponse['payload'] ?? "";

        if (!empty($apiResponse['status']) && $apiResponse['status'] === StatusType::CONFIRMED->value) {
            $payment['status_id'] = PaymentStatusType::CONFIRMED->value;
        }

        return $payment;
    }

    public function getAll(): PaymentCollection
    {
        $payments = $this->repository->all();
        return new PaymentCollection($payments);
    }

    public function getAllByMethod(string $methodName): PaymentCollection
    {
        $payments = $this->repository->allByMethod($methodName);
        return new PaymentCollection($payments);
    }

}

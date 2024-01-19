<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\CreateRequest;

class PaymentsController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function process(CreateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['payment']['client_ip_address'] = $request->ip();
            $response = $this->paymentService->process($data);

            return (new Response($response, Response::HTTP_OK));

        } catch (\Exception $exception){
            return response()->json(
                ['message' =>  $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}

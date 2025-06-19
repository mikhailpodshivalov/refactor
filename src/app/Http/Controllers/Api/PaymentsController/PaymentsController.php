<?php

namespace App\Http\Controllers\Api\PaymentsController;

use App\DTO\PaymentDTO;
use App\Repositories\PaymentsRepository\PaymentsRepositoryInterface;
use App\Services\PaymentService\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PaymentsController implements PaymentsControllerInterface
{
    public function __construct(
        protected PaymentsRepositoryInterface $paymentsRepository,
        protected PaymentService $paymentService
    )
    {}

    /**
     * @inheritDoc
     */
    public function pay(Request $request): JsonResponse
    {
        $paymentDTO = PaymentDTO::makeFromRequest($request);
        $this->paymentService->handle($paymentDTO);
        $payment = $this->paymentsRepository->create($paymentDTO);

        return response()->json($payment, 201);
    }
}

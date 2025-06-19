<?php

namespace App\Services\PaymentService;

use App\DTO\PaymentDTO;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function __construct(
        protected PaymentProcessorFactory $factory
    ) {}

    public function handle(PaymentDTO $paymentDTO): void
    {
        Log::info("Handling $paymentDTO->method payment for $paymentDTO->userId");

        $processor = $this->factory->make($paymentDTO->method);
        $processor->process($paymentDTO);
    }
}

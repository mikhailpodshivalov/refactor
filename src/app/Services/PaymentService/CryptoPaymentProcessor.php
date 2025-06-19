<?php

namespace App\Services\PaymentService;

use App\DTO\PaymentDTO;
use app\Enum\PaymentStatusType;
use App\Events\CryptoPaymentProcessed;
use Illuminate\Support\Facades\Log;

class CryptoPaymentProcessor implements PaymentProcessorInterface
{
    public function process(PaymentDTO $paymentDTO): void
    {
        Log::info("Processing crypto payment for user {$paymentDTO->userId}");

        $paymentDTO->status = PaymentStatusType::PROCESSING->value;

        event(new CryptoPaymentProcessed($paymentDTO));
    }
}

<?php

namespace App\Services\PaymentService;

use App\DTO\PaymentDTO;
use app\Enum\PaymentStatusType;
use App\Events\CardPaymentProcessed;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CardPaymentProcessor implements PaymentProcessorInterface
{
    public function process(PaymentDTO $paymentDTO): void
    {
        Log::info("Processing card payment for user {$paymentDTO->userId}");

        $response = Http::get("https://example.com/pay", [
            'uid' => $paymentDTO->userId,
            'sum' => $paymentDTO->amount,
        ]);

        $paymentDTO->status = /*$response->body() === 'OK'*/random_int(0, 1) ? PaymentStatusType::SUCCESS->value : PaymentStatusType::FAILED->value;

        event(new CardPaymentProcessed($paymentDTO));
    }
}

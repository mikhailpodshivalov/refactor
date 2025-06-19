<?php

namespace App\Services\PaymentService;

use app\Enum\PayMethodType;
use InvalidArgumentException;

class PaymentProcessorFactory
{
    public function make(string $method): PaymentProcessorInterface
    {
        return match ($method) {
            PayMethodType::CARD->value => app(CardPaymentProcessor::class),
            PayMethodType::CRYPTO->value => app(CryptoPaymentProcessor::class),
            default => throw new InvalidArgumentException("Unknown payment method: $method"),
        };
    }
}

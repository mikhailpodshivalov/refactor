<?php

namespace App\Events;

use App\DTO\PaymentDTO;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CryptoPaymentProcessed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public PaymentDTO $paymentDTO)
    {
    }
}

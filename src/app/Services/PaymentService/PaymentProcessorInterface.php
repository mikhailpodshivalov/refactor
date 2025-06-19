<?php

namespace App\Services\PaymentService;

use App\DTO\PaymentDTO;

interface PaymentProcessorInterface
{
    /**
     * @param PaymentDTO $paymentDTO
     * @return void
     */
    public function process(PaymentDTO $paymentDTO): void;
}

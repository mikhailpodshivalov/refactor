<?php

namespace App\Repositories\PaymentsRepository;

use App\DTO\PaymentDTO;
use App\Models\Payment;
use Throwable;

interface PaymentsRepositoryInterface
{
    /**
     * Create new payment
     *
     * @param PaymentDTO $paymentDTO
     *
     * @return Payment
     * @throws Throwable
     */
    public function create(PaymentDTO $paymentDTO): Payment;
}

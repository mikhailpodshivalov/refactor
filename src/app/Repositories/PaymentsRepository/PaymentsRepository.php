<?php

namespace App\Repositories\PaymentsRepository;

use App\DTO\PaymentDTO;
use App\Models\Payment;

class PaymentsRepository implements PaymentsRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(PaymentDTO $paymentDTO): Payment
    {
        $settings = new Payment();
        $settings->fill($paymentDTO->toArray());
        $settings->save();

        return $settings->refresh();
    }
}

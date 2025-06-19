<?php

namespace App\DTO;

use app\Enum\PaymentStatusType;
use app\Enum\PayMethodType;
use Illuminate\Http\Request;

class PaymentDTO
{
    /**
     * @param int $userId
     * @param float $amount
     * @param string $method
     * @param string|null $status
     */
    public function __construct(
        readonly public int $userId,
        readonly public float $amount,
        readonly public string $method,
        public ?string $status
    ) {}

    /**
     * @param Request $request
     * @return self
     */
    public static function makeFromRequest(Request $request): PaymentDTO
    {
        $payment = $request->get('payment');

        return new self(
            $request->get('user_id'),
            $request->get('amount'),
            $request->get('method'),
            null,
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'method' => PayMethodType::make($this->method),
            'status' => PaymentStatusType::make($this->status),
        ];
    }
}

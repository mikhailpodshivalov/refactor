<?php

namespace App\Validation;

use app\Enum\PayMethodType;
use Illuminate\Validation\Rule;

class PaymentPayValidator implements Validator
{
    /**
     * @inheritDoc
     */
    public function requestRules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
                'decimal:2',
            ],
            'method' => [
                'required',
                'string',
                Rule::in(PayMethodType::values()),
            ],
        ];
    }
}

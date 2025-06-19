<?php

namespace App\Models;

use app\Enum\PaymentStatusType;
use app\Enum\PayMethodType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $userId
 * @property float $amount
 * @property PayMethodType $method
 * @property PaymentStatusType $status
 * @property Carbon $created_at
 */
class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'status',
    ];

    public $timestamps = false;

    protected static function boot(): void
    {
        parent::boot();

        parent::saving(fn(self $payment) => $payment->created_at = Carbon::now()->toDateTimeString());
    }

    public function method(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => PayMethodType::make($value),
            set: fn(PayMethodType $value, $attributes) => $value->value,
        );
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => PaymentStatusType::make($value),
            set: fn(PaymentStatusType $value, $attributes) => $value->value,
        );
    }
}


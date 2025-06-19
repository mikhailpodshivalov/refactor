<?php

use App\Http\Controllers\Api\PaymentsController\PaymentsControllerInterface;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::controller(PaymentsControllerInterface::class)
        ->group(function () {
            Route::post('/payments', 'pay')
                ->middleware([
                    'validation.payment.pay',
                    'tx',
                ]);
        });
});

<?php

namespace App\Http\Controllers\Api\PaymentsController;;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface PaymentsControllerInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     *
     * OpenAPI/Swagger docs
     */
    public function pay(Request $request): JsonResponse;
}

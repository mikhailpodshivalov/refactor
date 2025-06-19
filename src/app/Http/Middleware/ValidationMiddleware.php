<?php

namespace App\Http\Middleware;

use App\Validation\Validator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as BaseValidator;
use Illuminate\Validation\ValidationException;

/**
 * Middleware for checking the validation of requests
 */
class ValidationMiddleware
{
    protected array $validators;

    /**
     * Middleware constructor
     *
     * @param Validator ...$validator
     */
    public function __construct(Validator...$validator)
    {
        $this->validators = $validator;
    }

    /**
     * Validates the request using pre-configured validators
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $requestData = [
                ...($request->route()->parameters() ?? []),
                ...$request->all(),
            ];

            /** @var Validator $validator */
            foreach ($this->validators as $validator) {
                BaseValidator::make($requestData, $validator->requestRules())->validate();
            }
        } catch (ValidationException $exception) {
            Log::error($exception->errors());
        }

        return $next($request);
    }
}

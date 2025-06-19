<?php

namespace App\Validation;

/**
 * Declares the validator interface. The validator must contain rules for verifying requests.
 */
interface Validator
{
    /**
     * Returns the validation rules for the request
     *
     * @return array
     */
    public function requestRules(): array;
}

<?php

namespace App\Validator;

use App\Exception\CnpValidationException;

class FormatValidator implements ValidatorInterface
{
    public const FORMAT_VALIDATOR_PRIORITY = 100;

    public function getPriority(): int
    {
        return self::FORMAT_VALIDATOR_PRIORITY;
    }

    /**
     * @throws CnpValidationException
     */
    public function validate(array $cnp): void
    {
        if (count($cnp) !== 13) {
            throw new CnpValidationException('CNP must be 13 numeric characters.');
        }
    }
}
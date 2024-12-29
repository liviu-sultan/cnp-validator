<?php

namespace App\Validator;

use App\Exception\CnpValidationException;

class ControlDigitValidator implements ValidatorInterface
{
    public const CONTROL_DIGIT_VALIDATOR_PRIORITY = 50;

    public function getPriority(): int
    {
        return self::CONTROL_DIGIT_VALIDATOR_PRIORITY;
    }

    /**
     * @throws CnpValidationException
     */
    public function validate(array $cnp): void
    {
        $controlFixedNumberDigits = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
        $checksum = 0;

        // Calculate the checksum for the first 12 digits
        for ($i = 0; $i < 12; $i++) {
            $checksum += $controlFixedNumberDigits[$i] * $cnp[$i];
        }

        // Calculate the control digit
        $controlDigit = $checksum % 11;
        $controlDigit = ($controlDigit === 10) ? 1 : $controlDigit;

        // Compare the control digit with the 13th digit in the CNP
        if ($controlDigit !== $cnp[12]) {
            throw new CnpValidationException('CNP has an invalid control digit.');
        }
    }
}

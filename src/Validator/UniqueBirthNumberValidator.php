<?php

namespace App\Validator;

use App\Exception\CnpValidationException;

class UniqueBirthNumberValidator implements ValidatorInterface
{
    public const BIRTH_NUMBER_VALIDATOR_PRIORITY = 60;

    public function getPriority(): int
    {
        return self::BIRTH_NUMBER_VALIDATOR_PRIORITY;
    }

    /**
     * @throws CnpValidationException
     */
    public function validate(array $cnp): void
    {
        $birthNumber = (int)($cnp[9] . $cnp[10] . $cnp[11]);

        if ($birthNumber < 1 || $birthNumber > 999) {
            throw new CnpValidationException('CNP has the unique 3 digit birth number out of range.');
        }
    }
}

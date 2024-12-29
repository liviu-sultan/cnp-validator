<?php

namespace App\Validator;

use App\Exception\CnpValidationException;

class BirthdateValidator implements ValidatorInterface
{
    public const BIRTH_DATE_VALIDATOR_PRIORITY = 80;

    public function getPriority(): int
    {
        return self::BIRTH_DATE_VALIDATOR_PRIORITY;
    }

    /**
     * @throws CnpValidationException
     */
    public function validate(array $cnp): void
    {
        $birthMonth = (int)($cnp[3] . $cnp[4]);
        $birthDay = (int)($cnp[5] . $cnp[6]);

        if ($birthMonth < 1 || $birthMonth > 12 || $birthDay < 1 || $birthDay > 31) {
            throw new CnpValidationException('CNP birth date is not valid.');
        }
    }
}

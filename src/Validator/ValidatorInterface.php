<?php

namespace App\Validator;

interface ValidatorInterface
{
    public function validate(array $cnp): void;

    public function getPriority(): int;
}
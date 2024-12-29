<?php

namespace App\Service;

use App\Exception\CnpValidationException;
use App\Validator\ValidatorInterface;

class ValidationManager
{
    private array $validators = [];

    public function __construct(iterable $validators)
    {
        foreach($validators as $validator) {
            $this->addValidator($validator, $validator->getPriority());
        }
    }

    public function addValidator(ValidatorInterface $validator, int $priority = 0): void
    {
        $this->validators[] = [
            'validator' => $validator,
            'priority' => $priority,
        ];

        // Sort the validators by priority in descending order
        usort($this->validators, function ($a, $b) {
            return $b['priority'] <=> $a['priority'];
        });
    }

    /**
     * @throws CnpValidationException
     */
    public function isCnpValid(string $value): bool
    {
        $charArr = str_split($value);
        $arrCnp = array_map('intval', $charArr);

        foreach ($this->validators as $validatorData) {
            $validator = $validatorData['validator'];
            $validator->validate($arrCnp);
        }

        return true;
    }
}
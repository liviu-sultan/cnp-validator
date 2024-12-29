<?php

namespace App\Validator;

use App\Entity\GenderMap;
use App\Exception\CnpValidationException;
use Doctrine\ORM\EntityManagerInterface;

class GenderValidator implements ValidatorInterface
{
    public const GENDER_VALIDATOR_PRIORITY = 90;

    public function getPriority(): int
    {
        return self::GENDER_VALIDATOR_PRIORITY;
    }

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws CnpValidationException
     */
    public function validate(array $cnp): void
    {
        $genderMapEntity = $this->entityManager->getRepository(GenderMap::class)->findOneBy(['genderId' => $cnp[0]]);
        if (!$genderMapEntity) {
            throw new CnpValidationException('CNP has invalid gender id.');
        }
    }
}
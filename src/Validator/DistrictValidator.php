<?php

namespace App\Validator;

use App\Entity\District;
use App\Exception\CnpValidationException;
use Doctrine\ORM\EntityManagerInterface;

class DistrictValidator implements ValidatorInterface
{
    public const DISTRICT_VALIDATOR_PRIORITY = 70;

    public function getPriority(): int
    {
        return self::DISTRICT_VALIDATOR_PRIORITY;
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
        $cnpDistrictId = (int)($cnp[7] . $cnp[8]);
        $district = $this->entityManager->getRepository(District::class)->findOneBy(['code' => $cnpDistrictId]);

        if (!$district) {
            throw new CnpValidationException('CNP has an invalid District ID.');
        }
    }
}

<?php

namespace App\Service;

use App\Entity\District;
use App\Entity\GenderMap;
use App\Exception\CnpValidationException;
use Doctrine\ORM\EntityManagerInterface;

class CnpValidatorService
{
    private Entitymanagerinterface $entityManager;

    public function __construct(Entitymanagerinterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws CnpValidationException
     */
    public function isCnpValid(string $cnp): bool
    {
        if (!$this->isValidFormat($cnp)) {
            throw new CnpValidationException('CNP must be 13 numeric characters.');
        }

        $arrCnp = $this->cnpToArray($cnp);

        if (!$this->hasValidGenderId($arrCnp)) {
            throw new CnpValidationException('CNP has invalid gender id.');
        }

        if (!$this->hasValidDistrictId($arrCnp)) {
            throw new CnpValidationException('CNP has an invalid District ID.');
        }

        if (!$this->hasValidUniqueBirthNumberPerRegionAndOffice($arrCnp)) {
            throw new CnpValidationException('CNP has the unique 3 digit birth number out of range.');
        }

        if (!$this->isValidControlDigit($arrCnp)) {
            throw new CnpValidationException('Invalid CNP control digit.');
        }

        return true;
    }

    private function isValidFormat(string $cnp): bool
    {
        return preg_match('/^\d{13}$/', $cnp);
    }

    private function isValidControlDigit(array $cnp): bool
    {
        $controlFixedNumberDigits = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
        $checksum = 0;

        for ($i = 0; $i < 12; $i++) {
            $checksum += $controlFixedNumberDigits[$i] * $cnp[$i];
        }

        $controlDigit = $checksum % 11;
        $controlDigit = $controlDigit === 10 ? 1 : $controlDigit;

        return $controlDigit === $cnp[12];
    }

    private function cnpToArray(string $cnp): array
    {
        $charArr = str_split($cnp);

        return array_map('intval', $charArr);
    }

    private function hasValidDistrictId(array $cnp): bool
    {
        $cnpDistrictId = $cnp[7] * 10 + $cnp[8];
        $districtEntity = $this->entityManager->getRepository(District::class)->findOneBy(['code' => $cnpDistrictId]);

        return (bool)$districtEntity;
    }

    private function hasValidUniqueBirthNumberPerRegionAndOffice(array $arrCnp): bool
    {
        $birthNumber = $arrCnp[9] * 100 + $arrCnp[10] * 10 + $arrCnp[11];

        return  (1 <= $birthNumber) && ($birthNumber <= 999);
    }

    private function hasValidGenderId($cnp): bool
    {
        $genderMapEntity = $this->entityManager->getRepository(GenderMap::class)->findOneBy(['genderId' => $cnp[0]]);

        return (bool)$genderMapEntity;
    }
}

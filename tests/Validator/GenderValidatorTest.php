<?php

namespace App\Tests\Validator;

use App\Entity\District;
use App\Exception\CnpValidationException;
use App\Repository\DistrictRepository;
use App\Validator\GenderValidator;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GenderValidatorTest extends TestCase
{
    private GenderValidator $validator;

    protected MockObject|EntityManagerInterface $entityManager;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        $this->validator = new GenderValidator($this->entityManager);
    }

    /**
     * @throws CnpValidationException
     * @throws Exception
     */
    public function testValidateWithValidCnp(): void
    {
        $districtEntityMock = $this->createMock(District::class);
        $districtRepositoryMock = $this->createMock(DistrictRepository::class);
        $districtRepositoryMock->method('findOneBy')->willReturn($districtEntityMock);

        $this->entityManager->method('getRepository')->willReturn($districtRepositoryMock);
        $validCnp = [2,9,9,0,2,1,9,4,6,9,0,0,0];
        $this->assertNull($this->validator->validate($validCnp));
    }

    public function testValidateWithInvalidGenderId(): void
    {
        $districtRepositoryMock = $this->createMock(DistrictRepository::class);
        $districtRepositoryMock->method('findOneBy')->willReturn(null);
        $this->entityManager->method('getRepository')->willReturn($districtRepositoryMock);

        $invalidCnp = [0,9,9,0,2,1,9,4,6,9,0,0,0];

        $this->expectException(CnpValidationException::class);
        $this->expectExceptionMessage('CNP has invalid gender id.');
        $this->validator->validate($invalidCnp);
    }
}

<?php

namespace App\Tests\Validator;

use App\Entity\District;
use App\Exception\CnpValidationException;
use App\Repository\DistrictRepository;
use App\Validator\DistrictValidator;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class DistrictValidatorTest extends TestCase
{
    private DistrictValidator $validator;

    protected MockObject|EntityManagerInterface $entityManager;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        $this->validator = new DistrictValidator($this->entityManager);
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

    public function testValidateWithInValidDistrictId(): void
    {
        $districtRepositoryMock = $this->createMock(DistrictRepository::class);
        $districtRepositoryMock->method('findOneBy')->willReturn(null);
        $this->entityManager->method('getRepository')->willReturn($districtRepositoryMock);

        $invalidCnp = [2,9,9,0,2,1,9,9,6,9,0,0,0];

        $this->expectException(CnpValidationException::class);
        $this->expectExceptionMessage('CNP has an invalid District ID.');
        $this->validator->validate($invalidCnp);
    }
}

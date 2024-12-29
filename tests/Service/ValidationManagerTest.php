<?php

namespace App\Tests\Service;
use App\Exception\CnpValidationException;
use App\Service\ValidationManager;
use App\Validator\ValidatorInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;


class ValidationManagerTest extends TestCase
{
    protected ValidationManager $manager;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $validator1 = $this->createMock(ValidatorInterface::class);
        $validator1->method('getPriority')->willReturn(1);

        $validator2 = $this->createMock(ValidatorInterface::class);
        $validator2->method('getPriority')->willReturn(2);

        $this->validationManager = new ValidationManager([$validator1, $validator2]);
    }

    /**
     * @throws CnpValidationException
     */
    public function testIsCnpValidWithValidCnp(): void
    {
        $cnp = '1234567890123';

        $isValid = $this->validationManager->isCnpValid($cnp);

        $this->assertTrue($isValid);
    }

    /**
     * @throws Exception
     */
    public function testIsCnpValidWithInvalidCnp(): void
    {
        // Create a mock validator that throws an exception
        $failingValidator = $this->createMock(ValidatorInterface::class);
        $failingValidator->method('getPriority')->willReturn(1);
        $failingValidator->method('validate')
            ->willThrowException(new CnpValidationException('Invalid CNP'));

        $validationManager = new ValidationManager([$failingValidator]);

        $this->expectException(CnpValidationException::class);
        $this->expectExceptionMessage('Invalid CNP');

        $validationManager->isCnpValid('123456789033123');
    }
}
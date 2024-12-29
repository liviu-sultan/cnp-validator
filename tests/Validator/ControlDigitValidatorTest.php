<?php

namespace App\Tests\Validator;

use App\Exception\CnpValidationException;
use App\Validator\ControlDigitValidator;
use PHPUnit\Framework\TestCase;

class ControlDigitValidatorTest extends TestCase
{
    private ControlDigitValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new ControlDigitValidator();
    }

    public function testValidateWithValidCnp(): void
    {
        $validCnp = [2,9,9,0,2,1,9,4,6,9,0,0,0];
        $this->assertNull($this->validator->validate($validCnp));
    }

    public function testValidateWithInvalidControlDigit(): void
    {
        $invalidCnp = [2,9,9,0,2,1,9,4,6,9,0,0,1];

        $this->expectException(CnpValidationException::class);
        $this->expectExceptionMessage('CNP has an invalid control digit.');
        $this->validator->validate($invalidCnp);
    }
}
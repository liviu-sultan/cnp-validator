<?php

namespace App\Tests\Validator;

use App\Exception\CnpValidationException;
use App\Validator\BirthdateValidator;
use PHPUnit\Framework\TestCase;

class BirthdateValidatorTest extends TestCase
{
    private BirthdateValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new BirthdateValidator();
    }

    public function testValidateWithValidCnp(): void
    {
        $validCnp = [2,9,9,0,2,1,9,4,6,9,0,0,0];
        $this->assertNull($this->validator->validate($validCnp));
    }

    public function testValidateWithInvalidBirthNumberCnp(): void
    {
        $validCnp = [2,9,9,9,2,9,1,4,6,9,0,0,0];

        $this->expectException(CnpValidationException::class);
        $this->expectExceptionMessage('CNP birth date is not valid.');
        $this->validator->validate($validCnp);
    }
}
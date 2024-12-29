<?php

namespace App\Tests\Validator;

use App\Exception\CnpValidationException;
use App\Validator\UniqueBirthNumberValidator;
use PHPUnit\Framework\TestCase;

class UniqueBirthNumberValidatorTest extends TestCase
{
    private UniqueBirthNumberValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new UniqueBirthNumberValidator();
    }

    public function testValidateWithValidCnp(): void
    {
        $validCnp = [2,9,9,0,2,1,9,4,6,9,0,0,0];
        $this->assertNull($this->validator->validate($validCnp));
    }

    public function testValidateWithInvalidBirthNumberCnp(): void
    {
        $validCnp = [2,9,9,0,2,1,9,4,6,0,0,0,0];

        $this->expectException(CnpValidationException::class);
        $this->expectExceptionMessage('CNP has the unique 3 digit birth number out of range.');
        $this->validator->validate($validCnp);
    }
}

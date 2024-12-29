<?php

namespace App\Tests\Validator;

use App\Exception\CnpValidationException;
use App\Validator\FormatValidator;
use PHPUnit\Framework\TestCase;

class FormatValidatorTest extends TestCase
{
    private FormatValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new FormatValidator();
    }

    public function testValidateWithValidCnp(): void
    {
        $validCnp = [2,9,9,0,2,1,9,4,6,9,0,0,0];
        $this->assertNull($this->validator->validate($validCnp));
    }

    public function testValidateWithShortCnp(): void
    {
        $shortCnp = [2,9,9,0,2,1,9,4,6];

        $this->expectException(CnpValidationException::class);
        $this->expectExceptionMessage('CNP must be 13 numeric characters.');
        $this->validator->validate($shortCnp);
    }
}

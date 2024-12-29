## CNP Validation App

This is a Symfony project designed to validate the Romanian Personal Numeric Code (CNP),

## Project Access

On a local machine you can access the project through the following URL: http://localhost:8080/cnp-form


## Unit Tests
To start unit tests please run the following command:  php vendor/bin/phpunit .\tests

## Features

1. Checks if the CNP has:
- a valid format 
- valid control digit
- valid district 
- gender unique birthday number
- valid birth month and date

2. Has PHPUnit tests for testing the functionality.

## CNP Format

The CNP is a 13-digit number with the following structure:

S AA LL ZZ JJ NNN C

Where:
- `S` - Gender and century of birth (odd for males, even for females).
- `AA` - Last two digits of the birth year.
- `LL` - Birth month (01 to 12).
- `ZZ` - Birth day (01 to 31).
- `JJ` - County or sector code of birth.
- `NNN` - A unique number assigned to the person within the county/sector on the birth date.
- `C` - Checksum digit calculated using a specific formula.

### Gender and Century Mapping:
- `1 / 2` - Born between 1900 and 1999.
- `3 / 4` - Born between 1800 and 1899.
- `5 / 6` - Born between 2000 and 2099.
- `7 / 8` - Foreign residents in Romania.
- `9` - Foreign citizens.

### Additional Information

The checksum is calculated by multiplying each of the first 12 digits by a corresponding digit from the sequence `279146358279`, summing the results, and taking the remainder when divided by 11. If the remainder is 10, the checksum is 1; otherwise, it is equal to the remainder.

## Installation

Clone the repository:
 ```
   git clone https://github.com/liviu-sultan/cnp-validator.git
 ```
Install dependencies using Composer:

composer install
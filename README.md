# Luhn

Luhn algorithm implementation for PHP. The Luhn algorithm is used in credit card numbers and national identity numbers.

## Installation

To add this package as a dependency to your project, simply add a dependency on `komakino/luhn` to your project's `composer.json` file.
```json
    {
        "require": {
            "komakino/luhn": "*"
        }
    }
```
### Usage

```php
use Komakino\Luhn\Luhn;
```

#### Static methods

*static* bool **validate**(string|int $number)

Validates a number.
```php
Luhn::validate('12345678'); // returns false
Luhn::validate('87654323'); // returns true
```

*static* int **calculate**(string|int $partial_number)

Calculates the check digit of a number.
```php
Luhn::validate('12345678'); // returns false
Luhn::validate('87654323'); // returns true
```

*static* string **appendCheckDigit**(string|int $partial_number)

Calculates the check digit and returns number with check digit appended.

Calculates the check digit of a number.
```php
Luhn::appendCheckDigit('1234567'); // returns 12345674
Luhn::appendCheckDigit('8765432'); // returns 87654323
```

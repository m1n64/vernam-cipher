# Vernam Cipher Implementation

## Description

The [VernamCipher](https://en.wikipedia.org/wiki/One-time_pad) package provides a simple and secure implementation of the Vernam cipher, also known as the one-time pad cipher. This encryption method requires a key that is the same length as the plaintext, ensuring maximum security. The key is applied using the XOR operation on each character of the plaintext. Read more about this cipher [this](https://en.wikipedia.org/wiki/One-time_pad).

## Installation

Make sure you have PHP version 8.1 or higher installed. You can install this package via Composer:

```bash
composer require m1n64/vernam-cipher
```

## Usage

### Example
```php
require 'vendor/autoload.php';

use Vasqo\VernamCipher\Vernam;

$vernam = new Vernam();

// Encrypt a message with a key
$plaintext = "Hello world!";
$key = $vernam->generateKeyFromPlaintext($plaintext); // Generates a key of the same length

$encrypted = $vernam->encrypt($plaintext, $key);
echo "Encrypted: " . $encrypted . "\n";

// Decrypt the message with the same key
$decrypted = $vernam->decrypt($encrypted, $key);
echo "Decrypted: " . $decrypted . "\n";

// Base64 encoding for encrypted data
$encryptedBase64 = $vernam->encryptBase64($plaintext, $key);
echo "Encrypted (Base64): " . $encryptedBase64 . "\n";

// Decrypt from Base64 encoding
$decryptedBase64 = $vernam->decryptBase64($encryptedBase64, $key);
echo "Decrypted (Base64): " . $decryptedBase64 . "\n";
```

### Example with Facade Usage
For a more concise and elegant approach, you can use the VernamFacade. The facade allows you to call the same methods as the `Vernam` class without needing to instantiate it directly.
```php
<?php

require 'vendor/autoload.php';

use Vasqo\VernamCipher\Facades\VernamFacade as Vernam;

$plaintext = "Hello world!";
$key = Vernam::generateKeyFromPlaintext($plaintext); // Generates a key of the same length

$encrypted = Vernam::encrypt($plaintext, $key);
echo "Encrypted: " . $encrypted . "\n";

$decrypted = Vernam::decrypt($encrypted, $key);
echo "Decrypted: " . $decrypted . "\n";

// Base64 encoding for encrypted data
$encryptedBase64 = Vernam::encryptBase64($plaintext, $key);
echo "Encrypted (Base64): " . $encryptedBase64 . "\n";

// Decrypt from Base64 encoding
$decryptedBase64 = Vernam::decryptBase64($encryptedBase64, $key);
echo "Decrypted (Base64): " . $decryptedBase64 . "\n";
```

## Tests

To run the tests, run the following command:

```bash
composer test
```

## Methods
* `__construct()`: Creates a new instance of the Vernam cipher class. There are no parameters for this method.
* `encrypt(string $plainText, string $key): string`: Encrypts the given plaintext using the provided key with the Vernam cipher.
  * **Parameters**:
     - `string $plainText`: The plaintext to encrypt.
     - `string $key`: The key to use for encryption (must be the same length as the plaintext).
  * **Return value**:
     - `string`: The encrypted text.
  * **Throws**:
     - `VernamKeyException`: If the lengths of plaintext and key do not match.
* `encryptBase64(string $plainText, string $key): string`: Encrypts the given plaintext and returns the result as a base64-encoded string.
    * **Parameters**:
        - `string $plainText`: The plaintext to encrypt.
        - `string $key`: The key to use for encryption (must be the same length as the plaintext).
    * **Return value**:
        - `string`: The base64-encoded encrypted text.
    * **Throws**:
        - `VernamKeyException`: If the lengths of plaintext and key do not match.
* `decrypt(string $encryptedText, string $key): string`: Decrypts the given encrypted text using the provided key.
    * **Parameters**:
        - `string $encryptedText`: The encrypted text to decrypt.
        - `string $key`: The key to use for encryption (must be the same length as the plaintext).
    * **Return value**:
        - `string`: The decrypted text.
    * **Throws**:
        - `VernamKeyException`: If the lengths of plaintext and key do not match.
* `decryptBase64(string $encryptedText, string $key): string`: Decrypts the given base64-encoded encrypted text using the provided key.
    * **Parameters**:
        - `string $encryptedText`: The base64-encoded encrypted text to decrypt.
        - `string $key`: The key to use for encryption (must be the same length as the plaintext).
    * **Return value**:
        - `string`: The decrypted text.
    * **Throws**:
        - `VernamKeyException`: If the lengths of plaintext and key do not match.
* `generateKeyFromPlaintext(string $plainText): string`: Generates a random key of the same length as the given plaintext. The key consists of printable ASCII characters.
    * **Parameters**:
        - `string $plainText`: The plaintext for which the key is to be generated.
    * **Return value**:
        - `string`: The generated random key.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Author
* m1n64

Feel free to modify any part of it as needed!
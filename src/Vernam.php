<?php
declare(strict_types=1);

namespace Vasqo\VernamCipher;

use Exception;
use Vasqo\VernamCipher\Exceptions\VernamKeyException;

class Vernam
{
    /**
     * Encrypts a given string with a given key using the Vernam cipher.
     *
     * @param string $plainText The plaintext to encrypt.
     * @param string $key The key to use for encryption.
     * @return string The encrypted text.
     * @throws VernamKeyException If the lengths of plaintext and key do not match.
     */
    public function encrypt(string $plainText, string $key): string
    {
        if (strlen($plainText) !== strlen($key)) {
            throw new VernamKeyException("The length of the plaintext and key must be the same.");
        }

        $encrypted = '';
        for ($i = 0; $i < strlen($plainText); $i++) {
            $encrypted .= $plainText[$i] ^ $key[$i];
        }

        return $encrypted;
    }

    /**
     * Encrypts a given string with a given key using the Vernam cipher.
     *
     * @param string $plainText The text to encrypt.
     * @param string $key The key to use for encryption.
     * @return string The encrypted text.
     * @throws VernamKeyException
     */
    public function encryptBase64(string $plainText, string $key): string
    {
        return base64_encode($this->encrypt($plainText, $key));
    }

    /**
     * Encrypts a given string with a given key using the Vernam cipher and returns the result as a base64 encoded string.
     *
     * @param string $encryptedText Encrypted text.
     * @param string $key The key to use for encryption.
     * @return string The encrypted text as a base64 encoded string.
     * @throws VernamKeyException
     */
    public function decrypt(string $encryptedText, string $key): string
    {
        return $this->encrypt($encryptedText, $key);
    }

    /**
     * Decrypts a given string with a given key using the Vernam cipher.
     *
     * @param string $encryptedText The text to decrypt.
     * @param string $key The key to use for decryption.
     * @return string The decrypted text.
     * @throws VernamKeyException
     */
    public function decryptBase64(string $encryptedText, string $key): string
    {
        return $this->decrypt(base64_decode($encryptedText), $key);
    }

    /**
     * Generates a random key of the same length as the given plaintext.
     *
     * @param string $plainText The plaintext for which the key is to be generated.
     * @return string The generated key.
     * @throws Exception If it was not possible to gather sufficient entropy.
     */
    public function generateKeyFromPlaintext(string $plainText): string
    {
        $length = strlen($plainText);

        $key = '';
        $randomBytes = random_bytes($length);
        for ($i = 0; $i < $length; $i++) {
            $key .= chr(32 + (ord($randomBytes[$i]) % 95));
        }

        return $key;
    }
}
<?php

namespace Vasqo\VernamCipher;

use PHPUnit\Framework\TestCase;
use Vasqo\VernamCipher\Exceptions\VernamKeyException;

class VernamTest extends TestCase
{
    /**
     * @var Vernam
     */
    public Vernam $vernam;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->vernam = new Vernam();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testGenerateKeyFromPlaintext(): void
    {
        $key = $this->vernam->generateKeyFromPlaintext('ABCD');
        $this->assertIsString($key);
        $this->assertEquals(4, strlen($key));
    }

    /**
     * @return void
     * @throws Exceptions\VernamKeyException
     */
    public function testEncryptBase64()
    {
        $plainText = 'Hello world!';
        $key = 'LQFZITJSZDCE';

        $result = $this->vernam->encryptBase64($plainText, $key);
        $this->assertEquals('BDQqNiZ0PTwoKCdk', $result);
    }

    /**
     * @return void
     * @throws VernamKeyException
     */
    public function testEncrypt()
    {
        $plainText = 'Hello world!';
        $key = 'LQFZITJSZDCE';

        $result = $this->vernam->encrypt($plainText, $key);
        $this->assertEquals(base64_decode('BDQqNiZ0PTwoKCdk'), $result);
    }

    /**
     * @return void
     * @throws VernamKeyException
     */
    public function testDecrypt()
    {
        $cipherText = base64_decode('BDQqNiZ0PTwoKCdk');
        $key = 'LQFZITJSZDCE';

        $result = $this->vernam->decrypt($cipherText, $key);
        $this->assertEquals('Hello world!', $result);
    }

    /**
     * @return void
     * @throws Exceptions\VernamKeyException
     */
    public function testDecryptBase64()
    {
        $cipherText = 'BDQqNiZ0PTwoKCdk';
        $key = 'LQFZITJSZDCE';

        $result = $this->vernam->decryptBase64($cipherText, $key);
        $this->assertEquals('Hello world!', $result);
    }

    /**
     * @return void
     * @throws VernamKeyException
     */
    public function testExceptionKeyLength()
    {
        $this->expectException(VernamKeyException::class);
        $this->vernam->encryptBase64("!@#$", "ABC");
    }
}

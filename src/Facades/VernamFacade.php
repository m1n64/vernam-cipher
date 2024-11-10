<?php
declare(strict_types=1);

namespace Vasqo\VernamCipher\Facades;

use Vasqo\VernamCipher\Vernam;

/**
 * @method static string encryptBase64(string $plaintext, string $key)
 * @method static string decryptBase64(string $encryptedText, string $key)
 * @method static string generateKeyFromPlaintext(string $plaintext)
 * @method static string encrypt(string $plaintext, string $key)
 * @method static string decrypt(string $encryptedText, string $key)
 */
class VernamFacade
{
    protected static Vernam $instance;

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (!isset(self::$instance)) {
            self::$instance = new Vernam();
        }

        if (method_exists(self::$instance, $name)) {
            return self::$instance->$name(...$arguments);
        }

        throw new \BadMethodCallException("Method {$name} does not exist in " . get_class(self::$instance));
    }
}
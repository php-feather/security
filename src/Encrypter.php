<?php

namespace Feather\Security;

use Feather\Support\Contracts\IEncrypter;

/**
 * Description of Encrypt
 *
 * @author fcarbah
 */
class Encrypter implements IEncrypter
{

    /** @var string * */
    protected $key;

    /** @var string * */
    protected $cipher;

    /** @var int * */
    protected $keyLength;

    /**
     *
     * @param string $key
     * @param string $cipher
     */
    public function __construct($key, $cipher = 'aes-128-cbc')
    {
        $cipher = strtolower($cipher);

        if (static::isSupported($key, $cipher)) {
            $this->cipher    = $cipher;
            $this->key       = $key;
            $this->keyLength = openssl_cipher_iv_length($cipher);
        }
    }

    /**
     *
     * @param string|mixed $value if not string, then set serialize to true
     * @param bool $serialize
     * @return string
     */
    public function encrypt($value, bool $serialize = false)
    {

        $iv = openssl_random_pseudo_bytes($this->keyLength);

        $rawVal = openssl_encrypt($serialize ? serialize($value) : $value, $this->cipher, $this->key, 0, $iv);

        $hmac = hash_hmac('sha256', $rawVal, $this->key, true);

        return base64_encode($iv . $hmac . $rawVal);
    }

    /**
     *
     * @param string $encryptedText
     * @param bool $unserialize - set this to true if serialize was set to true during encryption
     * @return mixed
     */
    public function decrypt(string $encryptedText, bool $unserialize = false)
    {
        $decoded = base64_decode($encryptedText);

        $iv = substr($decoded, 0, $this->keyLength);

        $hmac = substr($decoded, $this->keyLength, 32);

        $rawVal = substr($decoded, $this->keyLength + 32);

        $decryptedText = openssl_decrypt($rawVal, $this->cipher, $this->key, 0, $iv);

        return $unserialize ? unserialize($decryptedText) : $decryptedText;
    }

    /**
     *
     * @param int $strLength Length of string
     * @param bool $urlSafe
     * @return string
     */
    public static function generateRandomString(int $strLength, bool $urlSafe = true)
    {
        if ($urlSafe) {
            return substr(strtok(strtr(base64_encode(bin2hex(openssl_random_pseudo_bytes($strLength))), '/+', '_-'), '='), 0, $strLength);
        }

        return substr(strtok(base64_encode(bin2hex(openssl_random_pseudo_bytes($strLength)))), 0, $strLength);
    }

    /**
     *
     * @param string $key
     * @param string $cipher
     * @return boolean
     * @throws \RuntimeException
     */
    public static function isSupported($key, $cipher)
    {
        if (!in_array($cipher, openssl_get_cipher_methods())) {
            throw new \RuntimeException('Cipher not supported by OpenSSL.');
        }

        if (mb_strlen($key, '8bit') != openssl_cipher_iv_length($cipher)) {
            throw new \RuntimeException("Incorrect Key length");
        }

        return true;
    }

}

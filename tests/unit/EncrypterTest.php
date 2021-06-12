<?php

use Feather\Security\Encrypter;
use PHPUnit\Framework\TestCase;

/**
 * Description of EncrypterTest
 *
 * @author fcarbah
 */
class EncrypterTest extends TestCase
{

    /** @var \Feather\Security\Encrypter * */
    protected static $encrypter;

    public static function setUpBeforeClass(): void
    {
        $key = openssl_random_pseudo_bytes(16);
        static::$encrypter = new Encrypter($key);
    }

    public static function tearDownAfterClass(): void
    {
        static::$encrypter = null;
    }

    /**
     * @test
     */
    public function willEncryptString()
    {

        $encryptedVal = static::$encrypter->encrypt('plain text');

        $this->assertNotEmpty($encryptedVal);
        $this->assertTrue($encryptedVal != 'plain text');
    }

    /**
     * @test
     */
    public function willEncryptObject()
    {
        $obj = new stdClass();
        $obj->name = 'Steve';
        $obj->age = 30;
        $encryptedVal = static::$encrypter->encrypt($obj, true);
        $this->assertNotEmpty($encryptedVal);
    }

    /**
     * @test
     */
    public function willDecryptString()
    {
        $encryptedVal = static::$encrypter->encrypt('test');
        $decryptedVal = static::$encrypter->decrypt($encryptedVal);
        $this->assertNotEmpty($encryptedVal);
        $this->assertEquals('test', $decryptedVal);
    }

    /**
     * @test
     */
    public function willDecryptObject()
    {
        $obj = new stdClass();
        $obj->name = 'Steve';
        $obj->age = 30;
        $encryptedVal = static::$encrypter->encrypt($obj, true);
        $decrypted = static::$encrypter->decrypt($encryptedVal, true);
        $this->assertEquals($obj, $decrypted);
    }

}

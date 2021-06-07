<?php

use Feather\Security\Hash;
use PHPUnit\Framework\TestCase;

/**
 * Description of HashTest
 *
 * @author fcarbah
 */
class HashTest extends TestCase
{

    /**
     * @test
     */
    public function hashString()
    {
        $hashedStr = Hash::make('apple');
        $this->assertNotEmpty($hashedStr);
        $this->assertFalse($hashedStr == 'apple');
    }

    /**
     * @test
     */
    public function compareHashedStringIsEualToOriginal()
    {
        $hashedStr = Hash::make('apple');
        $this->assertNotEmpty($hashedStr);
        $this->assertTrue(Hash::compare($hashedStr, 'apple'));
    }

    /**
     * @test
     */
    public function willReturnFalseIfHashedStringIsNotEqualToOriginal()
    {
        $hashedStr = Hash::make('apple');
        $this->assertNotEmpty($hashedStr);
        $this->assertFalse(Hash::compare($hashedStr, 'orange'));
    }

}

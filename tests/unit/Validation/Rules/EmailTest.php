<?php

use Feather\Security\Validation\Rules\Email;
use PHPUnit\Framework\TestCase;

/**
 * Description of EmailTest
 *
 * @author fcarbah
 */
class EmailTest extends TestCase
{

    /**
     * @test
     */
    public function willPassForValidEmail()
    {
        $email = '123test@yahoo.com';
        $rule = new Email($email);
        $res = $rule->run();
        $this->assertTrue($res);
    }

    /**
     * @test
     */
    public function willFailForInvalidEmail()
    {
        $email = 'test@yahoodotcom';
        $rule = new Email($email);
        $res = $rule->run();
        $this->assertFalse($res);
    }

}

<?php

use Feather\Security\Validation\Rules\Regex;
use PHPUnit\Framework\TestCase;

/**
 * Description of RegexTest
 *
 * @author fcarbah
 */
class RegexTest extends TestCase
{

    /**
     * @test
     */
    public function willMatchUserSuppliedValidRegex()
    {
        $input = 'pa55w0rd!?';
        $regexPattern = '/w\d\w+!/i';
        $rule = new Regex($input, $regexPattern);
        $res = $rule->run();
        $this->assertTrue($res);
    }

}

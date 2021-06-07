<?php

use Feather\Security\Validation\Rules\RequiredIf;
use PHPUnit\Framework\TestCase;

/**
 * Description of RequiredIfTest
 *
 * @author fcarbah
 */
class RequiredIfTest extends TestCase
{

    /**
     * @test
     */
    public function willPassWhenBothConditionsAreMet()
    {
        $ifInput = '10';
        $isNumeric = new Feather\Security\Validation\Rules\Numeric($ifInput);
        $input = 'abcd';

        $rule = new RequiredIf($input, $isNumeric);
        $res = $rule->run();

        $this->assertTrue($res);
    }

    /**
     * @test
     */
    public function willPassWhenIfConditionNotMet()
    {
        $ifInput = 'abcd';
        $isNumeric = new Feather\Security\Validation\Rules\Numeric($ifInput);
        $input = 'abcd';

        $rule = new RequiredIf($input, $isNumeric);
        $res = $rule->run();

        $this->assertTrue($res);
    }

    /**
     * @test
     */
    public function willFailWhenParentConditionNotMet()
    {
        $ifInput = '10';
        $isNumeric = new Feather\Security\Validation\Rules\Numeric($ifInput);
        $input = '';

        $rule = new RequiredIf($input, $isNumeric);
        $res = $rule->run();

        $this->assertFalse($res);
    }

}

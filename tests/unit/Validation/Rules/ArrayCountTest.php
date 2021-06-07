<?php

use Feather\Security\Validation\Rules\ArrayCount;
use PHPUnit\Framework\TestCase;

/**
 * Description of ArrayCountTest
 *
 * @author fcarbah
 */
class ArrayCountTest extends TestCase
{

    /**
     * @test
     */
    public function willPassForArrayWithMinimum()
    {
        $array = ['a', 1, 2, 'b', 'c'];
        $alphaRule = new \Feather\Security\Validation\Rules\Alpha('z');
        $arrayCountRule = new ArrayCount($array, 3, $alphaRule);
        $res = $arrayCountRule->run();
        $this->assertTrue($res);
    }

    /**
     * @test
     */
    public function willFailForArrayWithLessThanMinimum()
    {
        $array = ['a', 1, 2, 'b', 'c'];
        $alphaRule = new \Feather\Security\Validation\Rules\Alpha('z');
        $arrayCountRule = new ArrayCount($array, 4, $alphaRule);
        $res = $arrayCountRule->run();
        $this->assertFalse($res);
    }

}

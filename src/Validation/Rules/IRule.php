<?php

namespace Feather\Security\Validation\Rules;

/**
 *
 * @author fcarbah
 */
interface IRule
{
    /**
     * @return boolean
     */
    public function run();
    
    /**
     * @return string
     */
    public function error();
}

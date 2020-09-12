<?php

namespace Feather\Security\Validation\Rules;

/**
 * Validate Email Address
 * Not strict. For a stricter email validation it is recommended
 * to use a regex rule or user defined rule
 *
 * @author fcarbah
 */
class Email extends Rule
{
    /**
     * 
     * @return string
     */
    public function error(): string
    {
        return 'Is not a valid email address';
    }
    
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        return preg_match('/.+@[^@]+\.[^@]+/i',$this->input);
    }

}

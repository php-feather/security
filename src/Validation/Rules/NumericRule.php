<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of NumericRule
 *
 * @author fcarbah
 */
class NumericRule extends Rule
{
    /**
     * 
     * @return string
     */
    public function error()
    {
        return 'Is not Numeric';
    }
    
    /**
     * 
     * @return boolean
     */
    public function run(){
        return is_numeric($this->input);
    }
    
}

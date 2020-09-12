<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of AlphaNumeric
 *
 * @author fcarbah
 */
class AlphaNumeric extends Rule
{
    /**
     * 
     * @return string
     */
    public function error()
    {
        return " Is not Alphanumeric";
    }
    
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        return preg_match('/^([a-z]*\d*)+(\s*[a-z]*\d*)*$/i',$this->input);
    }

}

<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Text
 *
 * @author fcarbah
 */
class Text extends Rule
{
    /**
     * 
     * @return string
     */
    public function error()
    {
        return "Is not a valid text";
    }
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        return preg_match('/^\w+(\s*\w*)*$/',$this->input);
    }

}

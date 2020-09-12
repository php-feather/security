<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Array
 *
 * @author fcarbah
 */
class IsArray extends Rule {
    /**
     * 
     * @return string
     */
    public function error()
    {
        return 'Is Not An Array';
    }
    
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        return is_array($this->input);
    }

}

<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Required
 *
 * @author fcarbah
 */
class Required extends Rule
{
    /**
     * 
     * @return string
     */
    public function error()
    {
        return "Is Required";
    }
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        return $this->input != null;
    }

}

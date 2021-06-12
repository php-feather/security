<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Array
 *
 * @author fcarbah
 */
class IsArray extends Rule
{

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'is_array';
    }

    /**
     *
     * @return string
     */
    public function error()
    {
        return 'is not an array';
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

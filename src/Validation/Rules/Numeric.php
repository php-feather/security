<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of NumericRule
 *
 * @author fcarbah
 */
class Numeric extends Rule
{

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'numeric';
    }

    /**
     *
     * @return string
     */
    public function error()
    {
        return 'is not numeric';
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        return is_numeric($this->input);
    }

}

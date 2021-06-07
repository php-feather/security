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
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'required';
    }

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

<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Alpha
 *
 * @author fcarbah
 */
class Alpha extends Rule
{

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'alpha';
    }

    /**
     *
     * @return string
     */
    public function error()
    {
        return "Is not Alpha";
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        return (bool) preg_match('/^([a-z]+)(\s*[a-z]*)*$/i', $this->input);
    }

}

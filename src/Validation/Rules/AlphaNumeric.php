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
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'alphanum';
    }

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
        return (bool) preg_match('/^([a-z]*\d*)+(\s*[a-z]*\d*)*$/i', $this->input);
    }

}

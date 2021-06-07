<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Text
 * Matches Word Character (letter, number, underscore)
 * @author fcarbah
 */
class Text extends Rule
{

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'text';
    }

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
        return (bool) preg_match('/^\w+(\s*\w*)*$/', $this->input);
    }

}

<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Text
 * Matches Word Character (letter, number, underscore)
 * @author fcarbah
 */
class Word extends Rule
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
        return "contains non word characters";
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

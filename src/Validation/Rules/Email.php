<?php

namespace Feather\Security\Validation\Rules;

/**
 * Validate Email Address
 * Not strict. For a stricter email validation it is recommended
 * to use a regex rule or user defined rule
 *
 * @author fcarbah
 */
class Email extends Rule
{

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'email';
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        return 'is not a valid email address';
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        return (bool) preg_match('/.+@[^@]+\.[^@]+/i', $this->input);
    }

}

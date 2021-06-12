<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Date
 *
 * @author fcarbah
 */
class Date extends Rule
{

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'date';
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        return 'is not a valid date';
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        $date = date_create($this->input);
        return $date instanceof \DateTime;
    }

}

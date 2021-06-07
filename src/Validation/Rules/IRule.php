<?php

namespace Feather\Security\Validation\Rules;

/**
 *
 * @author fcarbah
 */
interface IRule
{

    /**
     * Run validation rule
     * @return boolean
     */
    public function run();

    /**
     * Get error message
     * @return string
     */
    public function error();

    /**
     * Short name of Rule
     * return string
     */
    public static function alias();
}

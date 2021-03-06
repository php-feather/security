<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of RequiredIf
 *
 * @author fcarbah
 */
class RequiredIf extends Rule
{

    /** @var \Feather\Security\Validation\Rules\Rule * */
    protected $other;

    /**
     *
     * @param mixed $input
     * @param mixed $otherValue
     */
    public function __construct($input, $otherValue)
    {
        parent::__construct($input);

        $this->other = $otherValue;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'requiredif';
    }

    /**
     *
     * @return string
     */
    public function error()
    {
        return "is required";
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        if ($this->other != null) {
            return $this->input != null;
        }

        return true;
    }

}

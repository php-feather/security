<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of LessThan
 *
 * @author fcarbah
 */
class LessThan extends Rule
{

    protected $compareValue;

    public function __construct($input, $compareValue)
    {
        $this->compareValue = $compareValue;
        parent::__construct($input);
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'less_than';
    }

    public function error(): string
    {
        return "not less than";
    }

    public function run(): boolean
    {
        return $this->input < $this->compareValue;
    }

}

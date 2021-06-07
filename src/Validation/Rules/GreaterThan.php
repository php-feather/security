<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of GreaterThan
 *
 * @author fcarbah
 */
class GreaterThan extends Rule
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
        return 'greater_than';
    }

    public function error(): string
    {
        return "not greater than";
    }

    public function run(): boolean
    {
        return $this->input > $this->compareValue;
    }

}

<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of LessThanOrEqual
 *
 * @author fcarbah
 */
class LessThanOrEqual extends Rule
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
        return 'less_than_eq';
    }

    public function error(): string
    {
        return "is not less than or equal to";
    }

    public function run(): bool
    {
        return $this->input <= $this->compareValue;
    }

}

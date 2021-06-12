<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of GreaterThanOrEqual
 *
 * @author fcarbah
 */
class GreaterThanOrEqual extends Rule
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
        return 'greater_than_eq';
    }

    public function error(): string
    {
        return 'is not greater than or equal to' . $this->comparisonField ?: $this->compareValue;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function run(): \boolean
    {
        return $this->input > $this->compareValue;
    }

}

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

    /**
     *
     * {@inheritDoc}
     */
    public function error(): string
    {
        return 'is not greater than ' . $this->comparisonField ?: $this->compareValue;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function run(): bool
    {
        return $this->input > $this->compareValue;
    }

}

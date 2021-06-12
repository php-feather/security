<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Equal
 *
 * @author fcarbah
 */
class Equal extends Rule
{

    /** @var boolean * */
    protected $strict = false;
    protected $compareValue;

    public function __construct($input, $compareValue, $strict = false)
    {
        $this->strict = $strict;
        $this->compareValue = $compareValue;
        parent::__construct($input);
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'equal';
    }

    public function error(): string
    {
        return 'is not equal to ' . $this->comparisonField ?: $this->compareValue;
    }

    public function run(): bool
    {
        if ($this->strict) {
            return $this->input === $this->compareValue;
        }
        return $this->input == $this->compareValue;
    }

}

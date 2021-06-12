<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of MaxLength
 *
 * @author fcarbah
 */
class MaxLength extends Rule
{

    /** @var int * */
    protected $length;

    /**
     *
     * @param string $input
     * @param int $length
     */
    public function __construct($input, $length)
    {
        parent::__construct($input);
        $this->length = $length;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'max_length';
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        return 'length is greater than ' . $this->comparisonField ?: $this->length;
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        return strlen(trim($this->input)) <= $this->length;
    }

}

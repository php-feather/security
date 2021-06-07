<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of ExactLength
 *
 * @author fcarbah
 */
class Length extends Rule
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
        return 'length';
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        return "Length is not equal to {$this->length}";
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        return strlen(trim($this->input)) == $this->length;
    }

}

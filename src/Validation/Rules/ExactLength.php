<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of ExactLength
 *
 * @author fcarbah
 */
class ExactLength extends Rule
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
     * @return string
     */
    public function error(): string
    {
        return "Length is not equal to {$length}";
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

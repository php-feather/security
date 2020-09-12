<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of MaxLength
 *
 * @author fcarbah
 */
class MaxLength extends Rule
{
    /** @var int **/
    protected $length;
    
    /**
     * 
     * @param string $input
     * @param int $length
     */
    public function __construct($input,$length)
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
        return "Length exceeds maximum length requirement";
    }
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        return strlen(trim($this->input)) > $this->length;
    }

}

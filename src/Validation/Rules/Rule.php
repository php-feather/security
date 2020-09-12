<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Rule
 *
 * @author fcarbah
 */
abstract class Rule implements IRule
{
    /** @var mixed **/
    protected $input;
    
    public function __construct($input)
    {
        $this->input = $input;
    }
    
    /**
     * 
     * @return \Feather\Security\Validation\Rules\Rule
     */
    public static function getInstance(){
        $reflection = new \ReflectionClass(static::class);
        return $reflection->newInstanceArgs(func_get_args());
    }
    
    /**
     * 
     * @param mixed $input
     * @return $this
     */
    public function setInput($input){
        $this->input = $input;
        return $this;
    }
}

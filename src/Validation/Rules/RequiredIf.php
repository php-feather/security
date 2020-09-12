<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of RequiredIf
 *
 * @author fcarbah
 */
class RequiredIf extends Rule
{

    /** @var \Feather\Security\Validation\Rules\Rule **/
    protected $rule;
    
    /**
     * 
     * @param type $input
     * @param \Feather\Security\Validation\Rules\Rule $rule
     */
    public function __construct($input,Rule $rule)
    {
        parent::__construct($input);
        
        $this->rule = $rule;
    }
    
    /**
     * 
     * @return string
     */
    public function error()
    {
        return "Is Required";
    }
    
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        if($this->rule->run()){
            return $this->input != null;
        }
        
        return true;
    }

}

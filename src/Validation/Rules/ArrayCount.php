<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of ArrayCount
 *
 * @author fcarbah
 */
class ArrayCount extends Rule
{
    
    
    /** @var int **/
    protected $minimum = 0;
    
    /** @var \Feather\Security\Validation\Rules\Rule **/
    protected $rule;
    
    /**
     * 
     * @param array $input
     * @param int $minimum
     * @param \Feather\Security\Validation\Rules\Rule $rule
     */
    public function __construct($input,$minimum,Rule $rule = null)
    {
        parent::__construct($input);
        $this->rule = $rule;
        $this->minimum = $minimum;
    }
    
    /**
     * 
     * @return string
     */
    public function error()
    {
        return "Does not have valid minimum entries";
    }
    
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        if(!is_array($this->input)){
            return false;
        }
        
        if(count($this->input) < $this->minimum){
            return false;
        }
        
        $validCount = 1;
        
        for($i=0;$i<$this->minimum;$i++){

            if($this->rule && !$this->rule->setInput($this->input[$i])->run()){
                continue;
            }
            
            $validCount++;
            
            if($validCount > $this->minimum){
                break;
            }
            
        }

        return $validCount > $this->minimum;
    }
    
    /**
     * 
     * @param \Feather\Security\Validation\Rules\Rule $rule
     * @return $this
     */
    public function setRule(Rule $rule){
        $this->rule = $rule;
        return $this;
    }

}

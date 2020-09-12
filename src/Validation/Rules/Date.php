<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Date
 *
 * @author fcarbah
 */
class Date extends Rule
{
    
    /**
     * 
     * @return string
     */
    public function error(): string
    {
        return 'Is not a valid date';
    }
    
    /**
     * 
     * @return boolean
     */
    public function run()
    {
        try{
            
            if($this->input == null){
                return false;
            }
            $d = new \DateTime($this->input);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}

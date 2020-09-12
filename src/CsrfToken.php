<?php

namespace Feather\Security;

/**
 * Description of CsrfToken
 *
 * @author fcarbah
 */
class CsrfToken
{
    protected static $token;
    
    /**
     * 
     * @return string
     */
    public static function generate(){
        if(!self::$token){
            self::$token = feather_hash(bin2hex(random_bytes(32)));
        }
        
        return self::$token;
    }
}

<?php

namespace Feather\Security;

/**
 * Description of Encrypt
 *
 * @author fcarbah
 */
class Encrypter
{
    /** @var string **/
    protected $key;
    
    /** @var string **/
    protected $cipher;
    
    /** @var int **/
    protected $keyLength;
    
    /**
     * 
     * @param string $key
     * @param string $cipher
     */
    public function __construct($key,$cipher='aes-128-cbc')
    {
        $cipher = strtolower($cipher);
        
        if(static::isSupported($key,$cipher)){
            $this->cipher = $cipher;
            $this->key = $key;
            $this->keyLength = openssl_cipher_iv_length($cipher);
        }
    }
    
    /**
     * 
     * @param string|mixed $value if not string, then set serialize to true
     * @param boolean $serialize
     * @return string
     */
    public function encrypt($value,$serialize = false){
        
        $iv = openssl_random_pseudo_bytes($this->keyLength);
        
        $rawVal = openssl_encrypt($serialize? serialize($value) : $value, $this->cipher, $this->key, 0, $iv);
        
        $hmac = hash_hmac('sha256', $rawVal, $this->key,true);
        
        return base64_encode($iv.$hmac.$rawVal);
    }
    
    /**
     * 
     * @param string $encryptedText
     * @param true $unserialize - set this to true if serialize was set to true during encryption
     * @return string
     */
    public function decrypt($encryptedText, $unserialize=false){
        
        $decoded = base64_decode($encryptedText);
        
        $iv = substr($decoded,0,$this->keyLength);
        
        $hmac = substr($decoded, $this->keyLength,32);
        
        $rawVal  = substr($decoded, $this->keyLength+32);
        
        $decryptedText = openssl_decrypt($rawVal, $this->cipher, $this->key, 0, $iv);
        
        return $unserialize? unserialize($decryptedText) : $decryptedText;
    }
    
    /**
     * 
     * @param string $key
     * @param string $cipher
     * @return boolean
     * @throws \RuntimeException
     */
    public static function isSupported($key,$cipher){
        if(!in_array($cipher, openssl_get_cipher_methods())){
            throw new \RuntimeException('Cipher not supported by OpenSSL.');
        }
        
        if(mb_strlen($key,'8bit') != openssl_cipher_iv_length($cipher)){
            throw new \RuntimeException("Incorrect Key length");
        }
        
        return true;
    }
    
    
}

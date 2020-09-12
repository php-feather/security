<?php

namespace Feather\Security;

/**
 * Description of Encrypt
 *
 * @author fcarbah
 */
class Encrypter
{
    
    protected $key;
    
    protected $cipher;
    
    protected $keyLength;
    
    public function __construct($key,$cipher='aes-128-cbc')
    {
        $cipher = strtolower($cipher);
        
        if(self::isSupported($key,$cipher)){
            $this->cipher = $cipher;
            $this->key = $key;
            $this->keyLength = openssl_cipher_iv_length($cipher);
        }
    }
    
    public function encrypt($plainText,$serialize = false){
        
        $iv = openssl_random_pseudo_bytes($this->keyLength);
        
        $rawVal = openssl_encrypt($serialize? serialize($plainText) : $plainText, $this->cipher, $this->key, 0, $iv);
        
        $hmac = hash_hmac('sha256', $rawVal, $this->key,true);
        
        return base64_encode($iv.$hmac.$rawVal);
    }
    
    public function decrypt($encryptedText, $unserialize=false){
        
        $decoded = base64_decode($encryptedText);
        
        $iv = substr($decoded,0,$this->keyLength);
        
        $hmac = substr($decoded, $this->keyLength,32);
        
        $rawVal  = substr($decoded, $this->keyLength+32);
        
        $decryptedText = openssl_decrypt($rawVal, $this->cipher, $this->key, 0, $iv);
        
        return $unserialize? unserialize($decryptedText) : $decryptedText;
    }
    
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

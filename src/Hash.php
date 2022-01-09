<?php

namespace Feather\Security;

/**
 * Description of Hash
 *
 * @author fcarbah
 */
class Hash
{

    /**
     *
     * @param string $plainText
     * @param string $salt
     * @return string
     */
    public static function make($plainText, $salt = null)
    {
        return crypt($plainText, $salt ?: md5(time()));
    }

    /**
     *
     * @param string $hashedStr
     * @param string $plainText
     * @return boolean
     */
    public static function compare($hashedStr, $plainText)
    {
        return hash_equals($hashedStr, crypt($plainText, $hashedStr));
    }

}

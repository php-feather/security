<?php

/**
 *
 * @param string $text
 * @param string $secret
 * @param string $cipher
 * @param boolean $serialize
 * @return string
 */
function fs_encrypt($text, $secret, $cipher = 'aes-128-cbc', $serialize = false)
{
    $en = new Feather\Security\Encrypter($secret, $cipher);
    return $en->encrypt($text, $serialize);
}

/**
 *
 * @param string $cipherText
 * @param string $secret
 * @param string $cipher
 * @param boolean $unserialize
 * @return string
 */
function fs_decrypt($cipherText, $secret, $cipher = 'aes-128-cbc', $unserialize = false)
{
    $en = new Feather\Security\Encrypter($secret, $cipher);
    return $en->decrypt($cipherText, $unserialize);
}

/**
 * Generates CSRF token
 * @param string $id
 * @param int $expireAfter
 * @return Token
 */
function fs_csrf_token($id, $expireAfter = 0)
{
    return Feather\Security\Csrf\TokenManager::generate($id, $expireAfter);
}

/**
 *
 * @param string $value
 * @param string $salt
 * @return string
 */
function feather_hash($value, $salt = null)
{
    return \Feather\Security\Hash::make($value, $salt);
}

/**
 *
 * @param string $hashedText
 * @param string $plainText
 * @return boolean
 */
function feather_hash_equals($hashedText, $plainText)
{
    return \Feather\Security\Hash::compare($hashedText, $plainText);
}

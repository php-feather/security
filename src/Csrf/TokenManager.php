<?php

namespace Feather\Security\Csrf;

use Feather\Session\Session;

/**
 * Description of CsrfToken
 *
 * @author fcarbah
 */
class TokenManager
{

    const PREFIX = '__fs__csrf';

    /**
     *
     * @param \Feather\Security\Csrf\CsrfToken $token
     * @return \Feather\Security\Csrf\CsrfToken
     */
    public static function addToken(CsrfToken $token)
    {
        Session::set($token->getId(), $token);
        return $token;
    }

    /**
     *
     * @param string $id Token Id/name
     * @return \Feather\Security\Csrf\CsrfToken
     */
    public static function deleteToken($id)
    {
        $token = Session::get($id, true);
        return new CsrfToken($id, $token);
    }

    /**
     * @param string id Token Id/name
     * @param int $expireAfter Expiry time of csrf token
     * @return \Feather\Security\Csrf\CsrfToken
     */
    public static function generate(string $id, int $expireAfter = 0)
    {
        $value = strtr(base64_encode(random_bytes(32)), '+/', '-_');
        $token = rtrim($value, '=');
        $csrf  = new CsrfToken($id, $token, $expireAfter);
        Session::set($id, $csrf);
        return $csrf;
    }

    /**
     *
     * @param string $id Token Id/name
     * @return \Feather\Security\Csrf\CsrfToken
     */
    public static function getToken($id)
    {
        $token = Session::get($id);
        if ($token == null) {
            return static::generate($id);
        }
        return new CsrfToken($id, $token);
    }

    /**
     *
     * @param \Feather\Security\Csrf\CsrfToken $token
     * @return boolean
     */
    public static function isValidToken(CsrfToken $token)
    {

        $storedToken = Session::get($token->getId());

        if ($storedToken == null) {
            return false;
        }

        return !$storedToken->isExpired() && hash_equals($storedToken->getValue(), $token->getValue());
    }

    /**
     *
     * @param \Feather\Security\Csrf\CsrfToken $token
     * @return \Feather\Security\Csrf\CsrfToken
     */
    public static function refreshToken(CsrfToken $token)
    {
        return static::generate($token->getId(), $token->getExpire());
    }

}

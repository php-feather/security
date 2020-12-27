<?php

namespace Feather\Security\Csrf;

/**
 * Description of Token
 *
 * @author fcarbah
 */
class CsrfToken
{

    protected $id;
    protected $value;
    protected $expire = 0;
    protected $expireTime;

    /** @var int grace time in seconds * */
    const GRACE_TIME = 5;

    /**
     *
     * @param string $id
     * @param string $value
     * @param int expireAfter expiration time in minutes. 0 means until session expires
     */
    public function __construct(string $id, string $value, int $expireAfter = 0)
    {
        $this->id = $id;
        $this->value = $value;
        $this->setExpireTime($expireAfter);
    }

    public function getExpire()
    {
        return $this->expire;
    }

    /**
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @return boolean
     */
    public function isExpired()
    {
        if ($this->expire <= 0) {
            return false;
        }
        $time = time();
        return $time > $this->expireTime + static::GRACE_TIME;
    }

    /**
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     *
     * @param int $time
     */
    protected function setExpireTime(int $time)
    {
        if ($time > 0) {
            $this->expireTime = time() + ($time * 60);
            $this->expire = $time;
        }
    }

}

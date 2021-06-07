<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of UserDefined
 *
 * @author fcarbah
 */
class UserDefined extends Rule
{

    /** @var \Closure * */
    protected $closure;

    /** @var string * */
    protected $message;

    /**
     *
     * @param mixed $input
     * @param \Closure $closure
     * @param string $message
     */
    public function __construct($input, \Closure $closure, $message)
    {
        parent::__construct($input);
        $this->closure = $closure;
        $this->message = $message;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'custom';
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        return $this->message;
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        return call_user_func_array($this->closure, [$this->input]);
    }

}

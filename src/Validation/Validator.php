<?php

namespace Feather\Security\Validation;

use Feather\Security\Validation\Rules\Rule;

/**
 * Description of Validator
 *
 * @author fcarbah
 */
class Validator
{

    /** @var \Feather\Security\Validation\Validator * */
    protected static $self;

    /** @var array * */
    protected $rules = [];

    /**
     *
     * @return \Feather\Security\Validation\Validator
     */
    public static function getInstance()
    {
        if (!static::$self) {
            static::$self = new static();
        }
        return static::$self;
    }

    public function boot(array $registerRules)
    {
        $this->rules = $registerRules;
    }

    public function getRule($name)
    {
        if (isset($this->rules[$name])) {
            return $this->rules[$name];
        }
        return null;
    }

    public function registerRule($name, $class)
    {
        $this->rules[$name] = $class;
    }

}

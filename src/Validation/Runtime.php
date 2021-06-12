<?php

namespace Feather\Security\Validation;

use Feather\Security\Validation\Rules\Rule;

/**
 * Description of Validator
 *
 * @author fcarbah
 */
class Runtime
{

    /** @var \Feather\Security\Validation\Runtime * */
    protected static $self;

    /** @var array * */
    protected $rules = [];

    private function __construct()
    {
        $this->init();
    }

    /**
     *
     * @return \Feather\Security\Validation\Runtime
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
        $this->rules = array_merge($this->rules, $registerRules);
    }

    /**
     *
     * @param type $name
     * @return string|null Rule class name or null if not found
     */
    public function getRule($name)
    {
        if (isset($this->rules[$name])) {
            return $this->rules[$name];
        }
        return null;
    }

    /**
     *
     * @param string $name Alias of Rule
     * @param string $class Full namespaced of Rule class name
     * @return $this
     */
    public function registerRule($name, $class)
    {
        $this->rules[$name] = $class;
        return $this;
    }

    /**
     * register default rules
     */
    protected function init()
    {
        $this->rules = [
            Rules\AfterDate::alias() => Rules\AfterDate::class,
            Rules\Alpha::alias() => Rules\Alpha::class,
            Rules\AlphaNumeric::alias() => Rules\AlphaNumeric::class,
            Rules\ArrayCount::alias() => Rules\ArrayCount::class,
            Rules\BeforeDate::alias() => Rules\BeforeDate::class,
            Rules\Custom::alias() => Rules\Custom::class,
            Rules\Date::alias() => Rules\Date::class,
            Rules\Email::alias() => Rules\Email::class,
            Rules\Equal::alias() => Rules\Equal::class,
            Rules\GreaterThan::alias() => Rules\GreaterThan::class,
            Rules\GreaterThanOrEqual::alias() => Rules\GreaterThanOrEqual::class,
            Rules\IsArray::alias() => Rules\IsArray::class,
            Rules\Length::alias() => Rules\Length::class,
            Rules\LessThan::alias() => Rules\LessThan::class,
            Rules\LessThanOrEqual::alias() => Rules\LessThanOrEqual::class,
            Rules\MaxLength::alias() => Rules\MaxLength::class,
            Rules\Numeric::alias() => Rules\Numeric::class,
            Rules\Regex::alias() => Rules\Regex::class,
            Rules\Required::alias() => Rules\Required::class,
            Rules\RequiredIf::alias() => Rules\RequiredIf::class,
            Rules\RequiredIfRule::alias() => Rules\RequiredIfRule::class,
            Rules\Same::alias() => Rules\Same::class,
            Rules\SameSize::alias() => Rules\SameSize::class,
            Rules\Word::alias() => Rules\Word::class
        ];
    }

}

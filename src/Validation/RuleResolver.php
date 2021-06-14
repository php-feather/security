<?php

namespace Feather\Security\Validation;

use Feather\Security\Validation\Rules\IRule;

/**
 * Description of RuleResolver
 *
 * @author fcarbah
 */
class RuleResolver
{

    /** @var \Feather\Security\Validation\Runtime * */
    protected $runtime;

    /** @var array * */
    protected $data = [];

    /** @var array * */
    protected $rules = [];

    /** @var array * */
    protected $outputRules = [];

    /** @var array * */
    protected $comparisonFields = [];

    //fieldnames {fieldname}

    public function __construct()
    {
        $this->runtime = Runtime::getInstance();
    }

    public function getComparisonFields()
    {
        return $this->comparisonFields;
    }

    /**
     * Get Rule Instances
     * @return array
     */
    public function resolve()
    {
        $this->outputRules = [];
        foreach ($this->rules as $key => $rule) {
            if (is_array($rule)) {
                $this->parseRules($key, $rule);
            } else {
                $this->parseRule($key, $rule);
            }
        }

        return $this->outputRules;
    }

    /**
     *
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     *
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     *
     * @param string $key
     * @param string $ruleStr
     * @param bool $isArg
     * @return \Feather\Security\Validation\Rules\IRule
     * @throws ValidationException
     */
    protected function buildRule($key, $ruleStr, $isArg = false)
    {
        try {
            if (($pos = strpos($ruleStr, ':'))) {
                $alias = substr($ruleStr, 0, $pos);
                $argsStr = substr($ruleStr, $pos + 1);
                $args = $this->getArgs($argsStr);
            } else {
                $alias = $ruleStr;
                $args = array();
            }

            $params = $this->parseParams($key, $alias, $args);

            $rule = $this->runtime->getRule($alias);

            if ($rule == null) {
                throw new ValidationException("Rule {$alias} does not exist", 200);
            }

            return $this->instantiateRule($key, $rule, $params, $isArg);
        } catch (\Exception $e) {
            throw new ValidationException("Failed to resolve validation rule {$ruleStr}", 210, $e);
        }
    }

    /**
     *
     * @param string $argsStr
     * @return array
     */
    protected function getArgs($argsStr)
    {
        $matches = [];
        preg_match_all('/\s*(\([^)]*\)|[^,]+)/', $argsStr, $matches);

        if (empty($matches)) {
            return [];
        }

        $args = [];
        foreach ($matches[0] as $match) {
            $args[] = trim(str_replace(['(', ')'], ['', ''], $match));
        }

        return array_filter($args);
    }

    /**
     *
     * @param string $key
     * @param string $ruleClass
     * @param array $params
     * @param bool $isArg
     * @return \Feather\Security\Validation\Rules\IRule
     */
    protected function instantiateRule($key, $ruleClass, array $params, bool $isArg)
    {
        $reflection = new \ReflectionClass($ruleClass);
        if (!$isArg) {
            array_unshift($params, $this->data[$key] ?? null);
        } else {
            $constructor = $reflection->getConstructor();

            $required = $constructor->getNumberOfRequiredParameters();

            if (count($params) < $required) {
                array_unshift($params, $this->data[$key] ?? null);
            }
        }

        return $reflection->newInstanceArgs($params);
    }

    /**
     *
     * @param string $key Data field key
     * @param string $ruleAlias Rule alias
     * @param array $arguments
     * @return array
     */
    protected function parseParams($key, $ruleAlias, array $arguments)
    {

        $params = array();

        foreach ($arguments as $arg) {

            if (array_key_exists($arg, $this->data)) {
                $value = $this->data[$arg];
                $this->comparisonFields[$key][$ruleAlias] = $arg;
            } elseif (preg_match('/^\{(.*?)\}$/', $arg)) {
                $value = str_replace(['{', '}'], ['', ''], $arg);
            } else {
                $value = $this->buildRule($key, $arg, true);
            }

            $params[] = $value;
        }

        return $params;
    }

    /**
     *
     * @param string $key
     * @param IRule|string $rule
     */
    protected function parseRule($key, $rule)
    {

        if ($rule instanceof Rules\IRule) {
            $this->outputRules[$key][$rule->alias()] = $rule;
        }

        $parts = preg_split('/\|\|/', $rule);

        foreach ($parts as $part) {
            $iRule = $this->buildRule($key, $part);
            $this->outputRules[$key][$iRule->alias()] = $iRule;
        }
    }

    /**
     *
     * @param string $key
     * @param array $rules
     */
    protected function parseRules($key, array$rules)
    {
        foreach ($rules as $rule) {
            $this->parseRule($key, $rule);
        }
    }

}

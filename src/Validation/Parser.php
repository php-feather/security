<?php

namespace Feather\Security\Validation;

use Feather\Security\Validation\Rules\IRule;

/**
 * Description of Parser
 *
 * @author fcarbah
 */
class Parser
{

    /** @var \Feather\Security\Validation\Validator $validator * */
    protected $validator;

    /**
     *
     * @param \Feather\Security\Validation\Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * FORMAT
     * rulename:arg1,arg2,...
     * Rule_argument
     * if an argument is another rule put rule and arguments between pipe characters
     * |rulename:arg1,arg2,..|
     */

    /**
     *
     * @param type $class
     * @param array $arguments
     * @return \Feather\Security\Validation\Rules\IRule
     * @throws ValidationException
     */
    protected function getRule($class, array $arguments)
    {
        try {
            $rule = call_user_func_array("$class::getInstance", $arguments);
            if ($rule instanceof Rules\IRule) {
                return $rule;
            }
            throw new ValidationException("Rule does not exist");
        } catch (\Exception $e) {
            throw new ValidationException($e->getMessage());
        }
    }

    /**
     *
     * @param string $rule
     * @param mixed $fieldValue
     * @return \Feather\Security\Validation\Rules\IRule
     * @throws ValidationException
     */
    public function parseRule($rule, $fieldValue)
    {
        $ruleParts = explode(':', $rule);

        if (count($ruleParts) !== 2) {
            throw new ValidationException('Invalid Rule definition format');
        }

        $name = $ruleParts[0];

        $ruleClass = $this->validator->getRule($name);

        if (!$ruleClass) {
            throw new ValidationException("Rule {$name} does not exist");
        }

        $argumentList = explode(',', $ruleParts[1]);

        $arguments = [$fieldValue];

        foreach ($argumentList as $arg) {
            $arg = trim($arg);

            if (preg_match('/^(\|(.*?)\|)$/', $arg)) {
                $arguments[] = $this->buildRule($arg);
            } else {
                $arguments[] = $arg;
            }
        }

        return $this->getRule($ruleClass, $arguments);
    }

}

<?php

namespace Feather\Security\Validation;

/**
 * Description of Validator
 *
 * @author fcarbah
 */
class Validator
{

    /** @var array * */
    protected $rules = [];

    /** @var array * */
    protected $messages = [];

    /** @var array * */
    protected $input = [];

    /** @var \Feather\Security\Validation\ErrorBag * */
    protected $errorBag;

    /** @var \Feather\Security\Validation\RuleResolver * */
    protected $resolver;

    /** @var array * */
    protected $comparisonFields = [];

    public function __construct(array $input, array $rules, array $messages = [])
    {
        $this->errorBag         = new ErrorBag();
        $this->input            = $input;
        $this->messages         = $messages;
        $this->resolver         = new RuleResolver();
        $this->rules            = $this->resolver->setData($input)
                ->setRules($rules)
                ->resolve();
        $this->comparisonFields = $this->resolver->getComparisonFields();
    }

    /**
     *
     * @param array $input
     * @param array $rules
     * @param array $messages
     * @return \Feather\Security\Validation\Validator
     */
    public static function create(array $input, array $rules, array $messages = [])
    {
        $validator = new Validator($input, $rules, $messages);
        return $validator;
    }

    /**
     *
     * @return \Feather\Security\Validation\ErrorBag
     */
    public function errors()
    {
        return $this->errorBag;
    }

    /**
     *
     * @return boolean
     */
    public function validate()
    {

        $valid  = true;
        $errors = [];

        foreach ($this->rules as $field => $rules) {

            foreach ($rules as $alias => $rule) {

                $key = "$field.$alias";

                $isValid = $rule->run();

                if (!$isValid) {

                    $valid = false;

                    if (!isset($this->messages[$key])) {
                        if (isset($this->comparisonFields[$field][$alias])) {
                            $rule->setComparisonField($this->comparisonFields[$field][$alias]);
                        }
                        $msg = $field . ' ' . $rule->error();
                    } else {
                        $msg = $this->messages[$key];
                    }

                    $errors[$field][$alias] = $msg;
                }
            }
        }

        $this->errorBag->addItems($errors);

        return $valid;
    }

}

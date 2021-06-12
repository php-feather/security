<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of RequiredIfRule
 *
 * @author fcarbah
 */
class RequiredIfRule extends Rule
{

    /** @var \Feather\Security\Validation\Rules\Rule * */
    protected $rule;

    /**
     *
     * @param type $input
     * @param \Feather\Security\Validation\Rules\Rule $rule
     */
    public function __construct($input, Rule $rule)
    {
        parent::__construct($input);

        $this->rule = $rule;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'requiredif_rule';
    }

    /**
     *
     * @return string
     */
    public function error()
    {
        return "is required";
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        if ($this->rule->run()) {
            return $this->input != null;
        }

        return true;
    }

}

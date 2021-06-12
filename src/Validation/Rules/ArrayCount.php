<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of ArrayCount
 *
 * @author fcarbah
 */
class ArrayCount extends Rule
{

    /** @var int * */
    protected $minimum = 0;

    /** @var \Feather\Security\Validation\Rules\Rule * */
    protected $rule;

    /**
     *
     * @param array $input
     * @param int $minimum
     * @param \Feather\Security\Validation\Rules\Rule $rule
     */
    public function __construct($input, $minimum, Rule $rule = null)
    {
        parent::__construct($input);
        $this->rule = $rule;
        $this->minimum = $minimum;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'array_count';
    }

    /**
     *
     * @return string
     */
    public function error()
    {
        return "does not have mininum valid entries";
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        if (!is_array($this->input)) {
            return false;
        }

        if (count($this->input) < $this->minimum) {
            return false;
        }

        $validCount = 0;

        foreach ($this->input as $item) {

            if ($this->rule && !$this->rule->setInput($item)->run()) {
                continue;
            }

            $validCount++;

            if ($validCount >= $this->minimum) {
                break;
            }
        }

        return $validCount >= $this->minimum;
    }

    /**
     *
     * @param \Feather\Security\Validation\Rules\Rule $rule
     * @return $this
     */
    public function setRule(Rule $rule)
    {
        $this->rule = $rule;
        return $this;
    }

}

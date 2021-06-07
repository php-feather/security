<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Same
 *
 * @author fcarbah
 */
class Same extends Rule
{

    /** @var mixed * */
    protected $compareValue;

    /** @var boolean * */
    protected $caseInsensitive;

    /**
     *
     * @param string|int|boolean $input
     * @param string|int|boolean $compareValue
     * @param boolean $caseInsensitive
     */
    public function __construct($input, $compareValue, $caseInsensitive = true)
    {
        parent::__construct($input);
        $this->compareValue = $compareValue;
        $this->caseInsensitive = $caseInsensitive;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'same';
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        return "Does not match";
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        if ($this->caseInsensitive) {
            return strcasecmp(trim($this->input), trim($this->compareValue)) == 0;
        }

        return trim($this->input) == trim($this->compareValue);
    }

}

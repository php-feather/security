<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of Regex
 *
 * @author fcarbah
 */
class Regex extends Rule
{

    /** @var string * */
    protected $pattern;

    /**
     *
     * @param string $input
     * @param string $pattern Regex
     */
    public function __construct($input, $pattern)
    {
        parent::__construct($input);
        $this->pattern = $pattern;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'regex';
    }

    /**
     *
     * @return string
     */
    public function error()
    {
        return "does not match pattern";
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {
        return (bool) preg_match($this->pattern, $this->input);
    }

    /**
     *
     * @param string $pattern Regex
     * @return $this
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

}

<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of SameSize
 *
 * @author fcarbah
 */
class SameSize extends Rule
{

    /** @var \Countable * */
    protected $compare;

    public function __construct(\Countable $input, \Countable $compare)
    {
        parent::__construct($input);
        $this->compare = $compare;
    }

    public function error(): string
    {
        return 'is not the same size as ' . $this->comparisonField ?: $this->compare;
    }

    public function run(): bool
    {
        return sizeof($this->input) === sizeof($this->compare);
    }

    public static function alias()
    {
        return 'same_size';
    }

}

<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of AfterDate
 *
 * @author fcarbah
 */
class AfterDate extends Rule
{

    /**
     *
     * @var string
     */
    protected $compareDate;

    /**
     *
     * @param string $input
     * @param string|\Datetime $compareDate
     */
    public function __construct($input, $compareDate)
    {
        parent::__construct($input);
        $this->compareDate = $compareDate;
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        $msg = is_string($this->compareDate) ? $this->compareDate : $this->compareDate->format('Y-m-d h:i:s');
        return 'Date is not after ' . $msg;
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {

        if (is_string($this->compareDate)) {
            $cmpDate = new \DateTime($this->compareDate);
        } else {
            $cmpDate = $this->compareDate;
        }

        $date = new \DateTime($this->input);

        return $date->getTimestamp() > $cmpDate->getTimestamp();
    }

}

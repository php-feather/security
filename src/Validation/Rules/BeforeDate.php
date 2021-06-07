<?php

namespace Feather\Security\Validation\Rules;

/**
 * Description of BeforeDate
 *
 * @author fcarbah
 */
class BeforeDate extends Rule
{

    /**
     *
     * @var string|\Datetime
     */
    protected $compareDate;

    /**
     *
     * @param type $input
     * @param string|\Datetime $compareDate
     */
    public function __construct($input, $compareDate)
    {
        parent::__construct($input);
        $this->compareDate = $compareDate;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function alias()
    {
        return 'date_before';
    }

    /**
     *
     * @return string
     */
    public function error(): string
    {
        $msg = is_string($this->compareDate) ? $this->compareDate : $this->compareDate->format('Y-m-d h:i:s');
        return 'Date is not before ' . $msg;
    }

    /**
     *
     * @return boolean
     */
    public function run()
    {

        if (!$this->compareDate instanceof \DateTime) {
            $cmpDate = new \DateTime($this->compareDate);
        } else {
            $cmpDate = $this->compareDate;
        }

        $date = new \DateTime($this->input);

        return $date->getTimestamp() < $cmpDate->getTimestamp();
    }

}

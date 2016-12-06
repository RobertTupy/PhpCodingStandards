<?php
/**
 * Created by PhpStorm.
 * User: Robert Tupy <robert.tupy@example.gl>
 * Date: 06.06.16
 * Time: 10:00
 */

namespace Company;

/**
 * Class AbstractYear default implementation of YearInterface
 *
 * Explains order of declaration visibility of properties and methods,
 * always use visibility declaration (private, protected, public),
 * abstract methods 1st
 *
 * @package Company
 */
abstract class AbstractYear extends \DateTime implements YearInterface
{
    private $defaultFormat = 'Y';

    /**
     * Abstract declaration before visibility
     *
     * @param $format
     * @return mixed
     */
    abstract public function setDefaultFormat($format);

    private function getDefaultFormat()
    {
        return $this->defaultFormat;
    }

    public function getFormattedYear($format = null)
    {
        if (is_null($format)) {
            $format = $this->getDefaultFormat();
        }
        return $this->format($format);
    }

    public function isLeapYear()
    {
        $year = (int)$this->getFormattedYear();
        return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFormattedYear();
    }
}

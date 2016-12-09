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
    protected $defaultFormat = 'Y';

    static $defaultTimeZone = 'Europe/Prague';

    /**
     * AbstractYear constructor, that accept year as input parameter for default
     * @param string $year
     * @param \DateTimeZone $timezone
     */
    public function __construct($year, \DateTimeZone $timezone = null)
    {
        $year = intval($year);
        if (!$timezone) {
            $timezone = new \DateTimeZone(self::$defaultTimeZone);
        }
        parent::__construct($year . '-01-01 00:00:01', $timezone);
    }

    /**
     * Abstract declaration before visibility
     *
     * @param $format
     * @return mixed
     */
    abstract public function setDefaultFormat($format);

    protected function getDefaultFormat()
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
        $year = (int)$this->format('Y');
        return (($year % 4) === 0) && (($year % 100) !== 0 || ($year %400) === 0);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFormattedYear();
    }
}

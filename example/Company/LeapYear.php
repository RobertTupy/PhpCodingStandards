<?php
/**
 * Example of class file, shows properties, constants and methods naming convention
 *
 * Created by PhpStorm.
 * User: Robert Tupy <robert.tupy@example.gl>
 * Date: 06.06.16
 * Time: 10:00
 */

namespace Company;

/**
 * Class LeapYear
 * @package Company
 */
class LeapYear extends AbstractYear implements ValidatorInterface
{
    // class constants in UPPERCASE_WITH_UNDERSCORE
    const BADGE_VALID = 'is leap year';
    const BADGE_INVALID = 'is not leap year';

    // properties in camelCase
    // each array value delimited by comma, even the last one
    /**
     * @var array
     */
    private $badgeList = array(
        self::BADGE_VALID,
        self::BADGE_INVALID,
    );

    /**
     * @var string
     */
    protected $defaultFormat = 'Y-m-d';

    // method names in camelCase
    /**
     * @param string $format
     * @return $this fluent interface
     */
    public function setDefaultFormat($format)
    {
        $this->defaultFormat = $format;
        return $this;
    }

    public function isValid()
    {
        return $this->isLeapYear();
    }

    /**
     * @return array
     */
    public function listBadges()
    {
        return $this->badgeList;
    }
}

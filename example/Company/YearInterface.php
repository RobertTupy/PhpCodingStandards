<?php
/**
 * Created by PhpStorm.
 * User: Robert Tupy <robert.tupy@example.gl>
 * Date: 06.06.16
 * Time: 10:00
 */

namespace Company;

/**
 * Interface YearInterface
 * @package Company
 */
interface YearInterface
{
    /**
     * @link http://php.net/manual/en/datetime.format.php official DateTime::format documentation
     *
     * @param string $format accept same parameters as \DateTime::format
     *
     * @return string
     */
    public function getFormattedYear($format = "Y");

    /**
     * @return bool
     */
    public function isLeapYear();
}

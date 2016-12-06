<?php
/**
 * Created by PhpStorm.
 * User: Robert Tupy <robert.tupy@example.gl>
 * Date: 06.06.16
 * Time: 10:00
 */

namespace Company;

/**
 * Interface ValidatorInterface
 * @package Company
 */
interface ValidatorInterface
{
    /**
     * @return bool
     */
    public function isValid();
}

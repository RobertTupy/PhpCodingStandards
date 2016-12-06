<?php

/*
 * Best way to get rid of inclusions/requires is to use autoloader,
 * composer comes with such thing
 *
 * @link https://getcomposer.org/ PHP dependency manager
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Company' . DIRECTORY_SEPARATOR . 'YearInterface.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Company' . DIRECTORY_SEPARATOR . 'ValidatorInterface.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Company' . DIRECTORY_SEPARATOR . 'AbstractYear.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Company' . DIRECTORY_SEPARATOR . 'LeapYear.php';

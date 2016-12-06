<?php


/**
 * Example of code blocks and its align
 */

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

use Company\LeapYear;

// try catch block
try {
    $year = new LeapYear('2016-01-01 00:00:01');
} catch (Exception $e) {
    echo 'Caught exception: [' . $e->getCode() . ']' . $e->getMessage() . PHP_EOL;
    $year = new LeapYear('2016-01-01 00:00:01', new DateTimeZone('Europe/Prague'));
}

// condition
if ($year->isLeapYear()
    && ($badges = $year->listBadges())
    && count($badges)
) {
    // something to do
}

$year2 = clone $year;
$yearInterval = DateInterval::createFromDateString('+1 year');

// using fluent interface
$year2->setDefaultFormat('Y/m/d')
    ->add($yearInterval)
    ->add($yearInterval);

echo '$year: ' . $year . PHP_EOL;
echo '$year2: ' . $year2 . PHP_EOL;

$years = [];

// for cycle
for ($i = 0; $i < 10; $i++) {
    $y = clone $year;
    $add = DateInterval::createFromDateString('+' . $i . ' year');
    $y->add($add);
    $years[] = $y;
}

// switch
$yearsCount = count($years);
switch ($yearsCount) {
    case 0:
        echo 'no years generated' . PHP_EOL;
        break;
    case 10:
    default:
        echo 'size of generated years is ' . $yearsCount . PHP_EOL;
        break;
}

// foreach
foreach ($years as $index => $value) {
    echo $value  . " " . ($value->isValid() ? LeapYear::BADGE_VALID : LeapYear::BADGE_INVALID) . PHP_EOL;
    // conditions with constants in yoda style (constant first, to avoid accidental assign)
    if (8 <= $index) {
        break;
    }
}

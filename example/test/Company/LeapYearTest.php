<?php

namespace Company;

/**
 * Created by PhpStorm.
 * Date: 06.12.16
 * Time: 20:33
 */
class LeapYearTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Try to avoid factory methods in test,
     * complex factories can duplicate logic,
     * that should be concern of other unit (package)
     *
     * @param string $year
     * @return LeapYear
     */
    public function createYear($year)
    {
        return new LeapYear($year);
    }

    /**
     * One assert per test - per UNIT test,
     * unit is meant as single reason to change
     *
     * In this example we assert
     *  - class implements YearInterface
     *  - implemented method returns correct value
     *
     * @see self::testSetDefaultTimezoneByStaticProperty
     */
    public function testInterfaceYearImplementation()
    {
        $leapYear = $this->createYear('2016');
        $this->assertInstanceOf(YearInterface::class, $leapYear);
        $this->assertEquals('2016-01-01', $leapYear->getFormattedYear());
    }

    /**
     * Each test have to be focused on single problem.
     * Do NOT even think about merging those two tests
     * - testInterfaceYearImplementation, testInterfaceValidatorImplementation
     */
    public function testInterfaceValidatorImplementation()
    {
        $leapYear = new LeapYear('2016');
        $this->assertInstanceOf(ValidatorInterface::class, $leapYear);
        $this->assertTrue($leapYear->isValid());
    }

    /**
     * Test for default value should not be needed, in fact it is configuration.
     * Using static properties in this way, can be considered as anti-pattern.
     */
    public function testDefaultTimezoneIsEuropePrague()
    {
        $year = new LeapYear('2000');
        $this->assertEquals('Europe/Prague', $year->getTimezone()->getName());
    }

    /**
     * If we have feature in code that use static properties and relies on them,
     * then we should test it
     *
     * This example also show how we can describe
     * what should be affected by single action (impact of single action)
     * - original state, action/reason to change, expectations
     *
     * This style/concept of tests is more common in acceptance tests.
     *
     * Also notice underscore name of test
     * - underscore style is more readable when it comes to long names
     * - compare it to method below (testTimezoneAsParameterOfConstructor)
     */
    public function test_Set_Default_Timezone_By_Static_Property()
    {
        // original state
        $this->assertEquals('Europe/Prague', LeapYear::$defaultTimeZone);
        // change
        LeapYear::$defaultTimeZone = 'America/New_York';
        // expectations
        $this->assertEquals('America/New_York', LeapYear::$defaultTimeZone);
        $year = new LeapYear('2000');
        $this->assertEquals('America/New_York', $year->getTimezone()->getName());
    }

    /**
     * Don't forget to test, all constructor/methods parameters
     */
    public function testTimezoneAsParameterOfConstructor()
    {
        $year = new LeapYear('2000', new \DateTimeZone('America/New_York'));
        $this->assertEquals('America/New_York', $year->getTimezone()->getName());
    }

    /**
     * When testing different input parameters, use `@dataProvider` annotation
     *
     * @param $year
     * @param $expect
     * @dataProvider validatorProvider
     */
    public function testLeapYearIsValid($year, $expect)
    {
        /* it is better to use constructor instead of
         * $leapYear = $this->createYear($year);
         * factory method is far away at this point
         */
        $leapYear = new LeapYear($year);
        $this->assertEquals($expect, $leapYear->isValid());
    }

    /**
     * DataProvider for testLeapYearIsValid,
     *  - pick those values/combinations, that makes sense - be clever
     *  - don't generate values!!!
     *  - keep dataProvider close to test method
     *
     * @see self::testLeapYearIsValid
     *
     * @return array
     */
    public function validatorProvider()
    {
        return array(
            'valid if dividable by 4' => array('1904', true),
            'valid if dividable by 400' => array('2000', true),
            'invalid if not dividible by 4' => array('1901', false),
            'invalid if dividable by 100' => array('100', false),
        );
    }

    /**
     * Comparing
     *
     * @param $year
     * @dataProvider toStringProvider
     */
    public function testSameResultForToStringAndForGetFormattedYearWithDefaultFormat($year, $format)
    {
        $leapYear = new LeapYear($year);
        $leapYear->setDefaultFormat($format);
        $this->assertEquals((string) $leapYear, $leapYear->getFormattedYear());
    }

    /**
     * DataProvider for testLeapYearIsValid,
     *  - pick those values/combinations, that makes sense - be clever
     *  - don't generate values!!!
     *  - keep dataProvider close to test method
     *
     * @see self::testLeapYearIsValid
     *
     * @return array [year, format]
     */
    public function toStringProvider()
    {
        return array(
            array('1904', 'Y'),
            array('2000', 'Y-m-d'),
            array('1901', 'Y/m/d'),
            array('100', 'YY'),
        );
    }

    /**
     * Testing protected/private methods
     */
    public function testValidLeapYearWithIncorrectDefaultFormat()
    {
        $leapYear = new LeapYear('2016');
        // starting state
        $this->assertEquals('Y-m-d', $this->invokeMethod($leapYear, 'getDefaultFormat'));
        $this->assertTrue($leapYear->isValid());
        // change action
        $leapYear->setDefaultFormat("d");
        // expectation
        $this->assertEquals('d', $this->invokeMethod($leapYear, 'getDefaultFormat'));
        $this->assertTrue($leapYear->isValid());
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}

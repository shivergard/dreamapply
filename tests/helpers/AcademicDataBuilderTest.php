<?php

use Shivergard\DreamApply\AcademicDataBuilder;

use Carbon\Carbon;


class AcademicDataBuilderTest extends \PHPUnit_Framework_TestCase
{
    function __construct() {
        $this->startTestSuite();
    }

    protected static function getMethod($name) {
      $class = new ReflectionClass('Shivergard\DreamApply\AcademicDataBuilder');
      $method = $class->getMethod($name);
      $method->setAccessible(true);
      return $method;
    }

    public function startTestSuite()
    {

        $dataProvider = new AnObj();

        $dataProvider->data = function() { 
            return array(
                "2015" => array(
                    "name" => "2015/16",
                    "startdate" => "05-09-2015",
                    "termtype" => "semester",
                    "terms" => array(
                        array(
                            "code" => "2015-1",
                            "name" => "Autumn 2015/16",
                            "datestart" => "01-09-2015",
                            "dateend" => "08-12-2015"
                        ),
                        array(
                            "code" => "2015-2",
                            "name" => "Spring 2015/16",
                            "datestart" => "05-01-2016",
                            "dateend" => "17-04-2016"
                        )
                    )
                )
            );
        };

        $this->dataProvider = $dataProvider;

        $this->carnonDate = Carbon::parse("05.09.2015"); 
        $this->academic = new AcademicDataBuilder($this->carnonDate , $this->dataProvider ); 
    }

    public function testBasicExample()
    {
        $this->assertTrue($this->academic instanceof AcademicDataBuilder);
    } 

    //4.1. Given a date (D), return the academic year object (AY) that this date lies on.
    //    4.1.1. Decide what to do when the academic year is not configured. Return false, NULL, throw an exception?
    // 4.1.2. An academic year is considered "in effect" until the next academic year has not yet started. Make sure you get 2015-09-03 correct 
    public function testGetAcademicYearObject(){
        $getMatchingDateObject = $this->getMethod('getMatchingDateObject');
        $this->startTestSuite();
        $result = $getMatchingDateObject->invokeArgs($this->academic , array());

        //must be an array
        $this->assertTrue(is_array($result));

        $this->assertTrue(isset($result["name"]));
        $this->assertTrue(isset($result["startdate"]));
        $this->assertTrue(isset($result["termtype"]));

        $this->assertTrue(isset($result["terms"]));
        $this->assertTrue(count($result["terms"]) > 0);

        //must return false if date is not defined
        $this->academic = new AcademicDataBuilder(Carbon::now() , $this->dataProvider ); 

        $result = $getMatchingDateObject->invokeArgs($this->academic , array());

        //must be an array
        $this->assertTrue(!$result);
    }

    //4.2. Given the academic year (AY), get it's name, e.g. "2015/16"
    public function testGetAcademicYear(){
        $getAcademicYear = $this->getMethod('getAcademicYear');
        $this->startTestSuite();
        $result = $getAcademicYear->invokeArgs($this->academic , array());

        //must be an array
        $this->assertTrue(is_string($result));
        $this->assertTrue( $result == $this->dataProvider->data()[$this->carnonDate->year]['name']);
    }
    //4.3. Given the academic year (AY), return all the academic terms (AT) that belong to it.
    public function testGetAcademicTerm(){
        $getAcademicTerm = $this->getMethod('getAcademicTerm');
        $this->startTestSuite();
        $result = $getAcademicTerm->invokeArgs($this->academic , array());

        //must be an array
        $this->assertTrue(is_array($result));

        $this->assertTrue(count(array_diff(
            array(
                "code" => "2015-1",
                "name" => "Autumn 2015/16",
                "datestart" => "01-09-2015",
                "dateend" => "08-12-2015"
            ),
            $result
        )) == 0);
        
    }    
    //4.4. Given the academic term (AT), print it's name, e.g "Spring 2015/16"
    public function testGetAcademicTermName(){        
        $getAcademicTermName = $this->getMethod('getAcademicTermName');
        $this->startTestSuite();
        $result = $getAcademicTermName->invokeArgs($this->academic , array());

        //must be an array
        $this->assertTrue(is_string($result));
        $this->assertTrue( $result == 'Autumn 2015/16');
    }   
    //4.5. Given the academic term (AT), calculate it's length in calendar days.
    public function testGetAcademicTermLenght(){

        $getAcademicTermName = $this->getMethod('getAcademicTermLenght');
        $this->startTestSuite();
        $result = $getAcademicTermName->invokeArgs($this->academic , array());

        //must be an array
        $this->assertTrue(is_int($result));
        $this->assertTrue( $result == 98);
    }   

}
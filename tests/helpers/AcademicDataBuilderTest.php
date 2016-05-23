<?php

use Shivergard\DreamApply\AcademicDataBuilder;

class AcademicDataBuilderTest extends \PHPUnit_Framework_TestCase
{
    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->console = new AcademicDataBuilder();  
    }

    public function testBasicExample()
    {
        $this->assertTrue($this->console instanceof AcademicDataBuilder);
    } 
}
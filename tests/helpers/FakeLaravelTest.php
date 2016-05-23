<?php

use Shivergard\DreamApply\FakeLaravel;

class FakeLaravelTest extends \PHPUnit_Framework_TestCase
{
    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->console = new FakeLaravel('details');  
    }

    public function testBasicExample()
    {
        $this->assertTrue($this->console instanceof FakeLaravel);
    } 
}
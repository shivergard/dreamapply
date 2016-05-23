<?php

use Shivergard\DreamApply\AcademicConsole;
use Pimple\Container;

class AcademicConsoleTest extends \PHPUnit_Framework_TestCase
{
    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->console = new AcademicConsole(new Container);  
    }

    public function testBasicExample()
    {
        $this->assertTrue($this->console instanceof AcademicConsole);
    }
       
}
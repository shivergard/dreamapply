<?php

use Shivergard\DreamApply\Kernel;

class KernelTest extends \PHPUnit_Framework_TestCase
{
    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->console = new Kernel();  
    }

    public function testBasicExample()
    {
        $this->assertTrue($this->console instanceof Kernel);
    }    
}
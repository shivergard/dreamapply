<?php

use Shivergard\DreamApply\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->parser = new Parser('sample');  
    }

    public function testBasicExample()
    {
        $this->assertTrue($this->parser instanceof Parser);
    }

    public function testExtensionFileNotFoundError(){
        $this->parser = new Parser('correct.json'); 
        $this->assertTrue($this->parser->error() === 'file not found');
    }

    public function testExtensionErrorReturn(){     
        $this->parser = new Parser(dir(getcwd())->path.'/tests/files/wrong.extension'); 
        $this->assertTrue($this->parser->error() === 'wrong extension');
    }

    public function testEmptyFileErrorReturn(){     
        $this->parser = new Parser(dir(getcwd())->path.'/tests/files/wrong.json'); 
        $this->assertTrue($this->parser->error() === 'file empty');
    }

    public function testIncorrectJsonErrorReturn(){     
        $this->parser = new Parser(dir(getcwd())->path.'/tests/files/invalid.json'); 
        $this->assertTrue($this->parser->error() === 'invalid json');
    }

    public function testValidJsonReturn(){     
        $this->parser = new Parser(dir(getcwd())->path.'/tests/files/valid_fields.json'); 
        $this->assertTrue(!$this->parser->error());
        $this->assertTrue(is_array($this->parser->data()));
    }

}
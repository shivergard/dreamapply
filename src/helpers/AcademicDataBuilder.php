<?php namespace Shivergard\DreamApply;

use Carbon\Carbon;

class AcademicDataBuilder {

    /**
     * Error status
     * @var boolean
     */
    private $error = false;

    /**
     * Error message
     * @var String
     */
    private $errorMessage;

    /**
     * Result data
     * @var String
     */
    private $result;

    public function __construct(Carbon $date , \Shivergard\DreamApply\Parser $parserObject){

    }

    /**
     * Method to get Error status
     * @return boolean Error status
     */
    public function error(){
        return $this->error;
    }

    /**
     * Error message return
     * @return String Error message description
     */
    public function errorMessage(){
        return $this->errorMessage;
    }

    /**
     * Return Result string
     * @return String Results in compiled string
     */
    public function resultAsString(){
        return $this->result;  
    }


}
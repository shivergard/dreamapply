<?php namespace Shivergard\DreamApply;

use Carbon\Carbon;

class AcademicDataBuilder {

    /**
     * Date object
     * @var Carbon date
     */
    protected $date;

    /**
     * Private full data
     * @var Array
     */
    protected $fullData;

    /**
     * Error status
     * @var boolean
     */
    protected $error = false;

    /**
     * Error message
     * @var String
     */
    protected $errorMessage;

    /**
     * Result data
     * @var String
     */
    protected $result;

    public function __construct(Carbon $date , $dataProvider , $exec = true){
       $this->setDate($date);
       $this->setData($dataProvider->data());
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

    protected function setDate($date){
        $this->date = $date;
    }

    protected function setData($data){
        $this->fullData = $data;
    }

    protected function getMatchingDateObject(){
        if (isset($this->fullData[$this->date->year])){
            return $this->fullData[$this->date->year];
        }

        return false;
    }


}
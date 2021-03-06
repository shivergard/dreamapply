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
     * Matching Academic year Array
     * @var Array
     */
    protected $matchingData = false;

    /**
     * Matching academic term Array
     * @var Array
     */
    protected $matchingTermData;

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

       $this->getMatchingDateObject();
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
    public function resultAsArray(){

        $return = array(
                'Date belongs to academic year '.$this->getAcademicYear() ,
                'Academic year contains the ofllowing terms:',
        );

        foreach ($this->getMatchingDateObject()['terms'] as $term) {
           $return[] = $this->getAcademicTermName($term).' ('.$this->getAcademicTermLenght($term).' days )';
        }


        return $return;  
    }

    /**
     * Set date
     * @param Carbon $date
     */
    protected function setDate($date){
        $this->date = $date;
    }

    /**
     * Set input data
     * @param Array $data Academic data object
     */
    protected function setData($data){
        $this->fullData = $data;
    }

    /**
     * Set Error for response
     * @param String $error Error messge
     */
    protected function setError($error){
        $this->errorMessage = $error;
    }

    /**
     * Get matching date object
     * @return mixed Returns false or matching data details
     */
    protected function getMatchingDateObject(){
        
        if ($this->matchingData){
            return $this->matchingData;
        }else if (isset($this->fullData[$this->date->year])){
            $this->matchingData = $this->fullData[$this->date->year];
            return $this->matchingData;
        }

        $this->error = true;
        $this->setError('Date is not in Any academic year ');

        return false;
    }

    /**
     * Get academic year object by inputed data
     * @return Array Academic year data array
     */
    protected function getAcademicYear(){
        $matchingData = $this->getMatchingDateObject();
        return $matchingData['name'];  
    }

    /**
     * Get academic term object
     * @return Array Term object
     */
    protected function getAcademicTerm(){

        if ($this->matchingTermData)
            return $this->matchingTermData;

        $return = false;

        $matchingData = $this->getMatchingDateObject();


        foreach ($matchingData['terms'] as $term) {

            if($this->date->lt(Carbon::parse($term['dateend'])) && $this->date->gt(Carbon::parse($term['datestart']))){
                $return = $this->matchingTermData = $term;
                break;
            }
        }

        if (!$return){
            $this->setError('No matching Academic term');
        }

        return $return; 
    }

    /**
     * Get Actual Term name
     * @return String
     */
    protected function getAcademicTermName($term = false){
        if (!$term)
            $term = $this->getAcademicTerm();
        return $term['name'];
    }

    protected function getAcademicTermLenght($term = false){
        if (!$term)
            $term = $this->getAcademicTerm();
        
        return Carbon::parse($term['datestart'])
                     ->diff(Carbon::parse($term['dateend']))
                     ->days;
    }


}   
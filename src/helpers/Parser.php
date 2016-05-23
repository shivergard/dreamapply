<?php namespace Shivergard\DreamApply;

class Parser {

    private $allowedTypes = array('json');

    private $parser = false;

    private $parsedData = false;

    private $error = false;

    /**
     * construct
     * @param String $path Parsable file path
     */
    public function __construct($path){
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        //file existance check
        if (!file_exists($path)){
            $this->error = 'file not found';
            return;
        }

        //parse method check
        if (!method_exists($this , 'parse'.ucfirst($extension))){
            $this->error = 'wrong extension';
            return;
        }

        $this->parsedData = $this->{'parse'.ucfirst($extension)}($path);

    }

    /**
     * Error Message
     * @return String Error message
     */
    public function error(){
        if ($this->error){
            return $this->error;
        }else{
            return false;
        }
    }

    public function data(){
        return $this->parsedData;
    }

    private function parseJson($path){

        $fileContent = file_get_contents($path);

        //check has file content
        if (trim($fileContent) == ''){
            $this->error = 'file empty';
            return;
        }

        //invalid json
        $dataJson = json_decode($fileContent , true);

        if (json_last_error() != JSON_ERROR_NONE || !is_array($dataJson)){
             $this->error = 'invalid json';
            return;         
        }

        return $dataJson;

    }

}
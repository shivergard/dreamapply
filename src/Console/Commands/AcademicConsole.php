<?php namespace Shivergard\DreamApply;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Pimple\Container;

use Shivergard\DreamApply\Parser;
use Shivergard\DreamApply\AcademicDataBuilder;

use Carbon\Carbon;

class AcademicConsole extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'academic:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Details about academic data.';


    private $role_id = false;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $parser = new Parser($this->getFilePathInput());
        if ($parser->error()){
            $this->error($parser->error());
        }

        $academicData = new AcademicDataBuilder(Carbon::parse($this->getDate()) , $parser) ;

        if (!$academicData->error()){
            $this->info($academicData->resultAsString());
        }else{
            $this->error($parser->errorMessage());   
        }

    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getFilePathInput(){
        return $this->argument('filepath');
    }

    /**
     * Get date for Academic data calculation
     * @return string
     */
    protected function getDate(){
        return $this->argument('date');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('filepath', InputArgument::REQUIRED, 'data file path'),
            array('date', InputArgument::REQUIRED, 'date for academic data prepare')
        );
    }


}
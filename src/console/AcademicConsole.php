<?php namespace Shivergard\DreamApply;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Pimple\Container;

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
        $this->info('init accademic');
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getIdInput()
    {
        return $this->argument('id');
    }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('id', InputArgument::REQUIRED, 'ID of user'),
        );
    }


}
<?php namespace Shivergard\DreamApply;

use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Input\ArrayInput;


class FakeLaravel {

    private $command;

    public function __construct($command){
        $this->command = $command;
    }
    /**
     * Run an Artisan console command by name.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @return int
     */
    public function call($command, array $parameters = array())
    {
        $parameters['command'] = $command;

        $this->lastOutput = new BufferedOutput;

        return $this->command->fire(new ArrayInput($parameters), $this->lastOutput);
    }

}
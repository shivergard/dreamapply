<?php namespace Shivergard\DreamApply;


use Pimple\Container;
use Symfony\Component\Console\Application;

use Shivergard\DreamApply\Kernel;
use Shivergard\DreamApply\FakeLaravel;

class InitArtisan{
    /**
     * Init fake Artisan
     * @param  String $addName    Artisan Display name
     * @param  String $appVersion Artisan Display version
     */
    public function init($addName , $appVersion){

        $kernel = new Kernel();

        $app = new Application($addName , $appVersion);

        foreach ($kernel->getCommands() as $command => $path) {
            $container = new Container();
            $container['details'] = function ($c) use ($path) {
                $console = new $path($c);
                $console->setLaravel(new FakeLaravel($console));
                return $console;
            };

            $app->add($container['details']);

        }

        return $app;
    }
}
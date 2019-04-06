<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 05.04.2019
 * Time: 16:21
 */

namespace Vendor\Sparrow\Console;


class Console extends ConsoleMain
{
    public function __construct($argv)
    {
        $this->argv = $argv;
        $this->actions=require 'commands.php';
        $this->splitCommand();
        $this->checkArguments();    // checking the arguments that they exist, and are present in the array of commands. stop script if failed.


        $this->getActions();

        $this->run();
    }

    protected function run(){
        $this->html=<<<HTML
            run "$this->method" with arguments: "$this->arguments" $this->br
        HTML;

        $this->show();
    }


}

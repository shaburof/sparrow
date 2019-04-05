<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 05.04.2019
 * Time: 16:21
 */

namespace Vendor\Sparrow\Console;


class Console
{
    protected $argv;
    protected $commands = [
        'create' => [
            'auth' => 'auth'
        ],
        'help' => 'help'];

    public function __construct($argv)
    {
        $this->argv = $argv;
    }
}

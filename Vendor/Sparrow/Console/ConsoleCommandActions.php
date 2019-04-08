<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 06.04.19
 * Time: 9:57
 */

namespace Vendor\Sparrow\Console;


use Vendor\Sparrow\Console\ConsoleCommandsClass\CreateController;
use Vendor\Sparrow\Core\Builder;

class ConsoleCommandActions
{
    protected $html;
    protected $br = PHP_EOL;

    protected function help()
    {
        $this->html = <<<HTML
                     methods
----------------------------------------------$this->br
create:auth               - create auth table
create:controller         - create new controller, create:controller [directoryName.controllerName] [-r] - with CRUD methods
help                      - this help$this->br
HTML;
    }

    protected function auth($additionalParameters = null): void
    {
        dump($additionalParameters);
        dd('auth create');
    }

    protected function controller($additionalParameters = null): void
    {
        $create = Builder::sCreate(CreateController::class, false, $additionalParameters);
        $this->html=$create->create();

    }
}

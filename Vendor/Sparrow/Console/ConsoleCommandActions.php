<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 06.04.19
 * Time: 9:57
 */

namespace Vendor\Sparrow\Console;


use Vendor\Sparrow\Console\ConsoleCommandsClass\CreateAuth;
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
create:model              - create model class, create:model [modelName] [-t] - with basic table in database
help                      - this help$this->br
HTML;
    }

    protected function auth($additionalParameters = null): void
    {
        $create = Builder::sCreate(CreateAuth::class, false, $additionalParameters);
        $this->html=$create->create();
    }

    protected function controller($additionalParameters = null): void
    {
        $create = Builder::sCreate(CreateController::class, false, $additionalParameters);
        $this->html=$create->create();

    }
}

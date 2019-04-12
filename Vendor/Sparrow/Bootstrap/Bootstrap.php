<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 12.04.2019
 * Time: 8:38
 */

namespace Vendor\Sparrow\Bootstrap;


use App\Bootstrap\Launch;
use Vendor\Sparrow\Core\Builder;

class Bootstrap
{

    protected $actionRouter;
    protected $middleware;
    protected $launch;

    public function __construct($allThatIsNeeded)
    {
        [$this->actionRouter, $this->middleware] = $allThatIsNeeded;
        $this->launch = Builder::sCreate(Launch::class);
        $this->start();
    }

    protected function start()
    {
        $this->launch->beforeRouter();
        $this->middleware->handle();
        call_user_func($this->actionRouter);
    }

}

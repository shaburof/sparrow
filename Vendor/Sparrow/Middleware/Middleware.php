<?php


namespace Vendor\Sparrow\Middleware;


use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Core\Errors\Errors;

class Middleware
{
    protected $middlewares;
    protected $midleware;

    public function __construct(array $middleware)
    {
        $this->middlewares = require_once ROOT . 'Config/middleware.php';
        $this->midleware = $middleware;

//        $this->handle();
    }

    public function handle()
    {
        foreach ($this->midleware as $middleware) {

            if (!empty($this->middlewares[$middleware]) && class_exists($this->middlewares[$middleware])) {

                Builder::sCreate($this->middlewares[$middleware])->process();
            }
        }

    }
}

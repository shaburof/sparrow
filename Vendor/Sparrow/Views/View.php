<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 15:10
 */

namespace Vendor\Sparrow\Views;

Use Vendor\blade\BladeOne;

class View
{
    protected $blade;

    public function __construct()
    {
        $this->blade = getClass(BladeOne::class);
    }


    public function render(string $view, array $variables = []): string
    {
        return $this->blade->run($view, $variables);
        die();
    }

}

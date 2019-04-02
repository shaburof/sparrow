<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 15:10
 */

namespace Vendor\Sparrow\Views;

Use Vendor\blade\BladeOne;
use Vendor\Sparrow\Core\Errors\Errors;
//use Vendor\Sparrow\Core\Validate;

class View
{
//    protected $view;
//    protected $validate;
protected $blade;

    public function __construct()
    {
//        $this->validate = getClass(Validate::class);
        $this->blade=getClass(BladeOne::class);
    }


    public function render(string $view, array $variables = []): void
    {
        echo $this->blade->run($view,$variables);
//        foreach ($variables as $k => $v) {
//            $$k = $sanitize ? $this->validate->sanitizeString($v) : $v;
//        }

//        $this->view = $view;
//        require $this->getCorrectPath();
//        die();

    }

    protected function getCorrectPath(): string
    {
        $nested = $this->isNestedPath();
        $path = ROOT . "Resource/Views/$nested.php";
        if (file_exists($path)) {
            return $path;
        } else {
            return new Errors("отсутствует файл для отображениея $this->view");
        }
    }

    protected function isNestedPath(): string
    {
        $explodeViewPath = explode('.', $this->view);
        $path = '';
        if ($explodeViewPath > 0) {
            foreach ($explodeViewPath as $item) {
                $path .= $item . '/';
            }
            return rtrim($path, '/');
        } else {
            return $this->view;
        }
    }
}

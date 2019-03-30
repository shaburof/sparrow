<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 15:10
 */

namespace Vendor\Sparrow\Views;


use Vendor\Sparrow\Core\Errors\Errors;

class View
{
    protected $view;


    public function render(string $view, array $variables = []): void
    {
        foreach ($variables as $k => $v) {
            $$k = $v;
        }

        $this->view = $view;

        require $this->getCorrectPath();
    }

    protected function getCorrectPath(): string
    {
        $nested = $this->isNestedPath();
        $path = ROOT . "Resource/Views/$nested.php";
        if (file_exists($path)) {
            return $path;
            die();
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

<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 04.04.2019
 * Time: 12:38
 */

namespace Vendor\Sparrow\Core\Csrf;


class Csrf
{
    public $csrf;

    public function __construct()
    {
        $this->csrf = $this->createCsrf();
    }

    protected function createCsrf(): string
    {
        return substr(base64_encode(bin2hex(random_bytes(35))), 0, 93);
    }

    public function getCsrf(): string
    {
        return $this->csrf;
    }
}

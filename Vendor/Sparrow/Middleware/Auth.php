<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 11.04.19
 * Time: 21:04
 */

namespace Vendor\Sparrow\Middleware;


use Vendor\Sparrow\Login\Login;

class Auth
{

    protected $userAuth;
    protected $login;

    protected $status = null;

    public function __construct()
    {
        $this->userAuth = getClass(\Vendor\Sparrow\Auth\Auth::class);
        $this->login = getClass(Login::class);
    }

    public function process()
    {
        $this->check();
        $this->ifFailed();
    }

    protected function check(): void
    {
        $this->status = $this->userAuth->check();
    }

    protected function ifFailed()
    {
        if (!$this->status) {
            $this->login->logout();
            die();
        }
    }

}

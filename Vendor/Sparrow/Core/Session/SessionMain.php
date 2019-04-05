<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 04.04.2019
 * Time: 14:22
 */

namespace Vendor\Sparrow\Core\Session;


class SessionMain
{
    // :TODO сделать проверку $_SERVER['HTTP_USER_AGENT'] при проверке автоизации, после успешной авторизации записать хеш user_agent в сессию

    protected $frameworkSessionName = 'sparrow';
    protected $frameworkSession = [];

    public function __construct()
    {
        $this->frameworkSessionName .= env('key');
        $this->start();
        $this->frameworkSession = empty(@$this->get($this->frameworkSessionName)) ? (object)[] : (object)$this->get($this->frameworkSessionName);
    }

    protected function start(): void
    {
        ini_set('session.cookie_httponly', 1);
        session_start();
        session_regenerate_id();
    }

    public function store($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function purge()
    {
        session_reset();
        session_destroy();
    }

    public function __destruct()
    {
        $this->store($this->frameworkSessionName, $this->frameworkSession);
    }

}

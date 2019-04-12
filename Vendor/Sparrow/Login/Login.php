<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 14:53
 */

namespace Vendor\Sparrow\Login;


use App\Model\user;
use Vendor\Sparrow\Auth\Auth;
use Vendor\Sparrow\Core\Model\Model;

class Login
{

    use LoginHelpers;
    protected $nameLoginField;
    protected $userTable;

    protected $redirectLogin = '/home';
    protected $redirectLogout = '/login';

    public function __construct()
    {
        $this->nameLoginField = env('NAMELOGINFIELD', 'email');
        $this->userTable = new user();
    }

    public function login(string $name, string $password)
    {
        if ($this->attemt($name, $password)) {
            redirect($this->redirectLogin);
        } else {
            return false;
        }
    }

    public function signUp(array $authData)
    {
        $originPassword = $authData['password'];
        if ($this->registration($authData)) {
            $this->logout();
            return $this->login($authData[env('NAMELOGINFIELD')], $originPassword);
        }
        return false;
    }

    public function logout()
    {
        $this->logoutWithoutRedirect();

        redirect($this->redirectLogout);
    }


}

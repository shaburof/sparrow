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

class Login
{

    use LoginHelpers;
    protected $nameLoginField;
    protected $userTable;

    public function __construct()
    {
        $this->nameLoginField = env('NAMELOGINFIELD', 'email');
        $this->userTable = new user();
    }

    public function login(string $name, string $password): bool
    {
        $user = $this->userTable->select()->where($this->nameLoginField, '=', $name)->first();
        if (!empty($user)) {
            $hashPassword = $user->password;
            $attemt = $this->verifyPassword($hashPassword, $password);

            $auth = getClass(Auth::class);
            $auth->storeUserInSession($user);

            return $attemt;
        }
        return false;
    }

    public function signUp(array $authData)
    {
        $authData['password'] = $this->hashPassword($authData['password']);

        return $this->storeUser($authData);
    }

    public function logout()
    {
        unset(frameworkSession()->auth); // :TODO сделать переадресацию в слечае выхода
    }


    public function crypt(string $password): string
    {
        return $this->hashPassword($password);
    }

}

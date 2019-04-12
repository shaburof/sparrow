<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 14:58
 */

namespace Vendor\Sparrow\Login;


use Vendor\Sparrow\Auth\Auth;

trait LoginHelpers
{

    private $cost = 10;

    protected function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => $this->cost]);
    }

    protected function verifyPassword(string $hash, string $password): bool
    {
        return password_verify($password, $hash);
    }

    protected function storeUser(array $authData)
    {
        return $this->userTable->insert($authData);
    }

    public function logoutWithoutRedirect(){
//        session()->unsetAuth();
        getClass(Auth::class)->destroyAuthUser();
    }

    public function attemt($name, $password): bool
    {
        $user = $this->getUserFromDatabaseForCheckAuth($name);
        if (!empty($user)) {
            $hashPassword = $user->password;
            $attemt = $this->verifyPassword($hashPassword, $password);

            if ($attemt) {
                $auth = getClass(Auth::class);
                $auth->storeUserInSession($user);
                return true;
            }
        }
        return false;
    }

    public function registration(array $authData)
    {
        if (!$this->checkBeforeSignUp($authData)) return false;
        $authData['password'] = $this->hashPassword($authData['password']);
        return $this->storeUser($authData);
    }

    protected function getUserFromDatabaseForCheckAuth(string $name)
    {
        return $this->userTable->select()->where($this->nameLoginField, '=', $name)->first();
    }

    protected function checkBeforeSignUp(array $authData): bool
    {
        $nameField = env('NAMELOGINFIELD');
        if (empty($authData[$nameField])) return false;

        return true;
    }

    public function crypt(string $password): string
    {
        return $this->hashPassword($password);
    }

}

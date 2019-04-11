<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 14:58
 */

namespace Vendor\Sparrow\Login;


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

}

<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 16:08
 */

namespace Vendor\Sparrow\Auth;


class Auth extends AuthMain
{

    public function storeUserInSession($user)
    {
        $id = $user->getId();
        unset($user->password);
        frameworkSession()->auth = [
            'id' => $id,
            'userAgent' => sha1(userAgent()),
            'loginTime' => time(),
            'expired' => time() + $this->logoutExpiredTime
        ];

        $this->getUserFromSession();
    }

    public function user(): ?object
    {
        return !empty($this->user) ? $this->user : null;
    }

    public function check(): bool
    {
        $this->checkExpired();
        return (!empty(frameworkSession()->auth['id']) && $this->compareUserAgents());
    }

    public function isGuest(){
        return empty($this->userAgent) && empty($this->userId);
    }


    protected function compareUserAgents(): bool
    {
        return sha1(userAgent()) === frameworkSession()->auth['userAgent'];
    }

}

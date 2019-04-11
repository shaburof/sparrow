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
        $user=getVars($user);
        frameworkSession()->auth = [
            'id' => $id,
            'userAgent' => sha1(userAgent()),
            'user' => serialize($user)
        ];

        $this->getUserFromSession();
    }

}

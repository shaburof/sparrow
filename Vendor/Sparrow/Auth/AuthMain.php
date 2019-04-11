<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 16:07
 */

namespace Vendor\Sparrow\Auth;


class AuthMain
{

    protected $user = null;
    protected $userAgent = null;
    protected $userId = null;

    public function __construct()
    {
        $this->getUserFromSession();
    }

    protected function getUserFromSession(): void
    {
        if (!empty(frameworkSession()->auth)) {
            $this->user = (object)unserialize(frameworkSession()->auth['user']);
            $this->userAgent = frameworkSession()->auth['userAgent'];
            $this->userId = frameworkSession()->auth['id'];
        }
    }


}

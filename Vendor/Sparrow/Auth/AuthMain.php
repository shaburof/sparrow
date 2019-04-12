<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 16:07
 */

namespace Vendor\Sparrow\Auth;


use App\Model\user;
use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Login\Login;

class AuthMain
{

    protected $user = null;
    protected $userAgent = null;
    protected $userId = null;
    protected $loginTime = null;
    protected $expired = null;

    protected $logoutExpiredTime = null;

//    protected $login;

    public function __construct()
    {
        $this->logoutExpiredTime = env('AUTHEXPIRED', 3600);
        $this->getUserFromSession();
//        $this->login = getClass(Login::class);
        $this->checkExpired();
    }

    protected function getUserFromSession(): void
    {
        if (!empty(frameworkSession()->auth)) {
            $this->userAgent = frameworkSession()->auth['userAgent'];
            $this->userId = frameworkSession()->auth['id'];
            $this->user = Builder::sCreate(user::class)->find(frameworkSession()->auth['id'])->first(); // :TODO убрать из получаемого user из базы пароль
            $this->loginTime = frameworkSession()->auth['loginTime'];
            $this->expired = frameworkSession()->auth['expired'];
        }
    }

    public function destroyAuthUser()
    {
        session()->unsetAuth();
        unset($this->userAgent, $this->userId, $this->user, $this->loginTime, $this->expired);
    }

    protected function checkExpired()
    {
        if (!empty($this->expired) && $this->expired !== 'never'  && time() > $this->expired) {
            $this->destroyAuthUser();
        } elseif (!empty($this->expired)) {
            frameworkSession()->auth['expired'] = time() + $this->logoutExpiredTime;
        }
    }

}

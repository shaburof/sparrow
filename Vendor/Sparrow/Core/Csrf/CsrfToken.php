<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 05.04.2019
 * Time: 11:58
 */

namespace Vendor\Sparrow\Core\Csrf;


class CsrfToken
{
    protected $token;
    protected $expired;

    public function __construct(string $token, string $expired)
    {
        $this->token = $token;
        $this->expired = $expired;
    }

    public function expired(): bool
    {
        if (time() > $this->expired) return true;
        return false;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function compare(string $token): bool
    {
//        echo "this token: {$this->token} === {$token}<br>";
        return $this->token === $token;
    }

}

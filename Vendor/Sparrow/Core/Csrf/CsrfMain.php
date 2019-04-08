<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 05.04.2019
 * Time: 11:58
 */

namespace Vendor\Sparrow\Core\Csrf;


use Vendor\Sparrow\Core\Session\Session;

class CsrfMain
{
    protected $tokens = [];
    protected $expired;
    protected $count;
    protected $sessionVariableName = 'tokens';
    protected $session;

    public function __construct(int $expired, int $count)
    {
        $this->session = getClass(Session::class);
        $this->expired = (int)$expired * 60;
        $this->count = $count;
        $this->getTokensFromSession();
        $this->removeExpiredTokens();
    }


    protected function removeExpiredTokens()
    {
        foreach ($this->tokens as $token) {
            if ($token->expired()) {
                array_shift($this->tokens);
            }
        }

        $tokenCountsInSession = count($this->tokens);
        if ($tokenCountsInSession >= $this->count) {
            return false;
        }
        return true;
    }

    protected function createCsrfToken()
    {
        $tokenHash = bin2hex(openssl_random_pseudo_bytes(50)) . '-' . random_int(1, 12000);
        return new CsrfToken($tokenHash, time() + $this->expired);
    }

    protected function getTokensFromSession(): void
    {
        if (!empty($this->session->frameworkSession()->tokens)) {
            $this->tokens = $this->unserializeTokens($this->session->frameworkSession()->tokens);
        }
    }

    protected function unserializeTokens(string $Tokens): array
    {
        return unserialize($Tokens);
    }

    protected function serializeToken(array $tokens): string
    {
        return serialize($tokens);
    }
}

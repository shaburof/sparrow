<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 04.04.2019
 * Time: 12:38
 */

namespace Vendor\Sparrow\Core\Csrf;

class Csrf extends CsrfMain
{


    public function compare(string $userToken): bool
    {
        // :TODO сделать проверку устаревания токена, т.е. при проверке тоже должен запускаться метод обхода массива токенов с проверкой по времени. Вроде сделал, проверить.
        foreach ($this->tokens as $token) {
            if ($token->compare($userToken)) return true;
        }
        return false;
    }

    public function getToken(): string
    {
        if ($this->removeExpiredTokens()) {
            $token = $this->createCsrfToken();
            array_push($this->tokens, $token);
            $this->session->frameworkSession()->tokens = $this->serializeToken($this->tokens);

            return $token->getToken();
        }

        return $this->tokens[$this->count - 1]->getToken();
    }


}

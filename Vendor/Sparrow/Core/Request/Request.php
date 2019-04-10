<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 13:47
 */

namespace Vendor\Sparrow\Core\Request;

use Vendor\Sparrow\Core\Csrf\Csrf;
use Vendor\Sparrow\Core\Validate;

class Request
{
    protected $validate;
    protected $_csrf;
    protected $headers;
    protected $jsonRequest = false;

    public function __construct()
    {
        $this->_csrf = getClass(Csrf::class);

        $this->validate = getClass(Validate::class);
        $this->getDataFromRequest();

        $this->headers = getallheaders();
        $this->checkJsonRequest();

        if (requestMethod() === 'POST') $this->checkCsrfToken();
    }


    public function isJsonRequest(): bool
    {
        return $this->jsonRequest;
    }

    protected function checkJsonRequest(): void
    {
        if (strtolower(@$this->headers['Content-Type']) === 'application/json') $this->jsonRequest = true;
    }


    protected function getDataFromRequest(): void
    {
        if ($_GET) {
            $this->createProperty($_GET);
        } elseif ($_POST) {
            $this->createProperty($_POST);
        } elseif (file_get_contents('php://input')) {
            $data = json_decode(file_get_contents('php://input'));
            if (!empty($data)) $this->createProperty($data);
        }
    }

    protected function checkCsrfToken(): void
    {
        if (empty($this->csrf) || !$this->_csrf->compare($this->csrf)) throw new \Exception('csrf токен указан неверно');
    }

    protected function createProperty($params): void
    {
        foreach ($params as $k => $v) {
            $this->{$k} = $this->validate->cleaning($v);
        }
    }


}

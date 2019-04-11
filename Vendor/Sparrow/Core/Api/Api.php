<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 10:28
 */

namespace Vendor\Sparrow\Core\Api;


use Vendor\Sparrow\Core\Errors\Errors;
use Vendor\Sparrow\Core\Response\Response;

abstract class Api
{

    protected $data;
    protected $response;
    protected $responseCode;
    protected $responseMessage;


    public function __construct($data, int $responseCode = null, string $responseMessage = null)
    {
        $this->response = getClass(Response::class);
        $this->data = $data;
        $this->responseCode = $responseCode;
        $this->responseMessage = $responseMessage;
        $this->data = $this->changeDataBeforeSend($this->data);
    }

    public function send()
    {
        if ($this->responseCode) $this->response->setResponseCode($this->responseCode, $this->responseMessage);

        $this->decideHowToShipData();
        return $this->data;
    }

    protected function changeDataBeforeSend($data)
    {
        if (is_object($data)) return $this->Prepare($data);
        elseif (is_array($data)) {
            return array_map(function ($item) {
                return $this->Prepare($item);
            }, $data);
        } else {
            throw new Errors('The information sent to api is incorrect');
        }
    }

    protected function decideHowToShipData(): void
    {
        if (isJson()) $this->data = JSON($this->data);
    }

    public static function run($api, $data, $responseCode = null, $responseMessage = null)
    {
        $api = new $api($data, $responseCode, $responseMessage);
        return $api->send();
    }

    abstract protected function Prepare($data);


}

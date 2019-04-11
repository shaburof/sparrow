<?php

namespace Vendor\Sparrow\Core\Response;


class Response
{
    protected $code;
    protected $message;
    protected $header;

    public function __construct()
    {

    }

    public function setResponseCode(int $code, string $message = null): void
    {
        $this->code = $code;
        $this->message = $message;
        $this->header = "HTTP/1.1 {$this->code} {$this->message}";

        $this->setHeader();
    }

    protected function setHeader()
    {
        header($this->header);
        unset($this->header);
    }

}

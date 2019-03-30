<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 11:44
 */

namespace Vendor\Sparrow\Core\Errors;

use Throwable;

class ClassMissing extends Errors
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

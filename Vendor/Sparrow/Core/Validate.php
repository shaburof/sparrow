<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 14:23
 */

namespace Vendor\Sparrow\Core;


use Vendor\Sparrow\Core\Validation\ValidateMethods;

class Validate
{
    use ValidateMethods;

    protected $data;

    public function cleaning($data)
    {
        $this->escaped($data);
        return $this->data;
    }


    protected function escaped($data): void
    {
        if (is_array($data)) {
            $this->data = array_map(function ($value) {
                return $this->clean($value);
            }, $data);
        } else {
            $this->data = $this->clean($data);
        }

    }

    protected function clean(string $value): string
    {
        return htmlentities($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public function cleanUriParameters(array $parameters): array
    {
        return array_map(function ($value) {
            return protectionFromTags(protectedFromQuotes($value));
        }, $parameters);

    }
}

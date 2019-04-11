<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 02.04.2019
 * Time: 10:09
 */

namespace Vendor\Sparrow\Core\Validation;


trait ValidateMethods
{
// экранирием теги
    function protectionFromTags($string)
    {
        if (is_array($string)) {
            return array_map(function ($item) {
                if(is_array($item)) return $this->protectionFromTags($item);
                else return htmlentities($item, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }, $string);
        } else {
            return htmlentities($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
    }

// экранируем кавычки одинарные и двойные
    function protectedFromQuotes($string)
    {
        return filter_var($string, FILTER_SANITIZE_MAGIC_QUOTES);
    }

// убираем теги из вывода
    function sanitizeString($string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

// только цифрыи знаки плюс минус и минус
    function sanitizeFloat($float)
    {
        return filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

//    protected function ifEnterArray($string){
//        if(is_array($string)){
//
//        }
//
//        return
//    }

// только допустимые для электронного адреса символы
    function sanitizeEmail($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    function sanitizeUrl($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }
}

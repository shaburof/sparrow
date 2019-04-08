<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 08.04.19
 * Time: 20:23
 */

namespace Vendor\Sparrow\Date;


class Date
{

    protected $now;
    protected $dateTime;

    public function __construct()
    {
        $this->dateTime = new \DateTime('now', new \DateTimeZone(env('TIMEZONE')));
        $this->now = $this->dateTime->format('Y-m-d H:m:s');
    }

    public function now($format=null): string
    {
        if($format==='date') return $this->dateTime->format('Y-m-d');
        elseif ($format==='time') return $this->dateTime->format('H:m:s');
        else return $this->now;
    }

    public function dateTime():\DateTime
    {
        return $this->dateTime;
    }
}

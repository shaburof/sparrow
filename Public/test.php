<?php
echo '<pre>';

class A
{

    public function __construct()
    {
        $this->foo();
    }

    public function foo()
    {
        return 'string';
    }

}

echo (new A())->foo();

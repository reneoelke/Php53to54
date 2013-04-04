<?php

use OtherVendor\SpecialInterface as SomeInterface;

class SomeClass extends SomeBaseClass implements SomeInterface
{
    public function someMethod()
    {
        // code here
        // a much to long line ..................................................................................... warning
    }
}

$notAllowed;

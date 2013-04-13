<?php

// valid
MyClass::array_combine(array(), array());
$obj->array_combine(array(), array());
$array_combine(array(), array());

// 'invalid'
// both arrays may be empty
array_combine($foo, $bugs);
if (array_combine($foo, $bugs)) {}
"foobugs".array_combine($foo, $bar);
// empty array since php 5.4, did return false before
$usage = array_combine(array(), array());

// TODO stupid test cases (wrong argument type)
return array_combine($foo, "bugs");

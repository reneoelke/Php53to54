<?php

// valid stuff
function foo($var)
{
    $var++;
}
sprintf('', 1 & 2);
class MyClass {

	function foo($var)
	{
	    $var++;
	}
}

function foo(&$var)
{
    $var++;
}

function foo(array &$var)
{
    $var++;
}

function foo(Vendor\SomeClass &$var)
{
    $var++;
}

class MyClass {

	function foo(&$var)
	{
	    $var++;
	}
}

// invalid
MyClass::foo(&$foo);
foo(&$foo);
"string".foo(&$foo);
foo('something', &$foo);
$obj->foo(& $foo);
$obj->foo(
    new someClass(&$foo),
    array(1,'a', new stdClass, &$foo)
);
new $someClass(&$foo);

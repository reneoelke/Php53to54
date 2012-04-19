<?php

// valid stuff
function foo($var)
{
    $var++;
}

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
foo('something', (&$foo));
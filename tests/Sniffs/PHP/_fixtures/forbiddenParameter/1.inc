<?php

// valid
function batz($foo, $bar) {}
$foo($_GET);
foo($_GET);
$obj->foo($_GET);
myClass::foo($_GET);
$_GET = array();
$x = function ($x) use ($_GET) {};

// invalid
function foo($_GET,$_POST, $GLOBALS) {}

function abc(
    $foo,
    $bugs = '$_GET',
    $GLOBALS
) {

}

class MyClass {
    abstract function bar($_GET);
}

function bar(array $_GET, callable $GLOBALS) {}

$callback = function($a, $_GET) use ($x, $y) {};

// checklist
function foo($GLOBALS) {}
function foo($_SERVER) {}
function foo($_GET) {}
function foo($_POST) {}
function foo($_SET) {}
function foo($_FILES) {}
function foo($_COOKIE) {}
function foo($_SESSION) {}
function foo($_REQUEST) {}
function foo($_ENV) {}

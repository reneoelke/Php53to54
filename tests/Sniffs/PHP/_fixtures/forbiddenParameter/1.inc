<?php

function foo($_GET,$_POST, $GLOBALS) {

}

function abc(
$GLOBALS
) {

}

function bar(array $_GET, $_POST, callable $GLOBALS) {

}

function batz($foo, $bar) {

}

$callback =
	function($a, $_GET) use ($x, $y)
	{

	};

// checklist
        '$GLOBALS' => true,
        '$_SERVER' => true,
        '$_GET' => true,
        '$_POST' => true,
        '$_SET' => true,
        '$_FILES' => true,
        '$_COOKIE' => true,
        '$_SESSION' => true,
        '$_REQUEST' => true,
        '$_ENV' => true,
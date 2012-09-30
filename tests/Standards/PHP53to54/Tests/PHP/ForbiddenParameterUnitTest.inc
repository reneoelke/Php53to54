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
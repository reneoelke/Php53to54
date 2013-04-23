<?php

// valid calls
MyClass::get_magic_quotes_runtime();
$get_magic_quotes_runtime();
$obj->get_magic_quotes_runtime();

// invalid calls
get_magic_quotes_runtime();

echo get_magic_quotes_gpc();

// checklist
get_magic_quotes_runtime();
get_magic_quotes_gpc();
set_magic_quotes_runtime();

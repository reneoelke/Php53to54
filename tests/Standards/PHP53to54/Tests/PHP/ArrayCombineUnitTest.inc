<?php

// valid

// invalid
array_combine($foo, $bugs);
if (array_combine($foo, $bugs)) {}
$usage = array_combine(array(), array());
"foobugs".array_combine($foo, $bar);
return array_combine($foo, "bugs");
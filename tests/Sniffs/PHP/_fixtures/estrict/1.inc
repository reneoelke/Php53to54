<?php

// valid
echo error_reporting(E_ALL);
error_reporting(E_ALL ^ E_STRICT); // meaningful as of PHP 5.4+
error_reporting(E_ALL | ~E_STRICT); // meaningful as of PHP 5.4+

// invalid
error_reporting(E_ALL | E_STRICT);
error_reporting(E_STRICT | E_ALL);
error_reporting(E_STRICT | E_NOTICE | E_ALL);
echo error_reporting(E_ALL & E_STRICT); // stupid test

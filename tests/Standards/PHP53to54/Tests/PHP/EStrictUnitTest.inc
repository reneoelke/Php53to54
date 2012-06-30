<?php

// valid
echo error_reporting(E_ALL);

// invalid
error_reporting(E_ALL | E_STRICT);
error_reporting(E_ALL | ~E_STRICT);
echo error_reporting(E_ALL & E_STRICT);

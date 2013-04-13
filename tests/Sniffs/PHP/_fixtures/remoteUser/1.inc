<?php

// valid
echo 'echo $_SERVER[REMOTE_USER];';
$var = 'REMOTE_' . 'USER';
$_SERVER["REMOTE_" . "USER"];

// invalid
foo("echo $_SERVER[REMOTE_USER];");
echo $_SERVER['REMOTE_USER'];
$_SERVER["REMOTE_USER"];
$var = 'REMOTE_USER';

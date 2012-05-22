<?php

// valid
echo 'echo $_SERVER[REMOTE_USER];';

// invalid
echo $_SERVER['REMOTE_USER'];
echo $_SERVER["REMOTE_USER"];
$var = 'REMOTE_USER';
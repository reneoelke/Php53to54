<?php

// valid calls
putenv(' TZ=anything');

echo "putenv('TZ_anything')";

// invalid calls
putenv('TZ=Europe/Amsterdam');
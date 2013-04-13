<?php

// valid calls
putenv(' TZ=anything');
echo "putenv('TZ_anything')";
getenv('TZ');

// invalid calls
putenv(
    /* comment */
    "TZ=Europe/Amsterdam");
putenv("TZ=" . '*');
putenv( "TZ=$timezone" );

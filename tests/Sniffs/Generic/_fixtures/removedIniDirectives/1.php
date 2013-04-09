<?php

// valid
echo "define_syslog_variables";
ini_set('anything', 'define_syslog_variables');

// invalid
ini_set('define_syslog_variables', true);
ini_set("define_syslog_variables", true);
ini_set(
    (string)
    /* long comment */
    "define_syslog_variables"
	,
	true
);

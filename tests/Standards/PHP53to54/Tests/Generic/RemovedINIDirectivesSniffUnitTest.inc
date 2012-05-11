<?php

// valid
echo "define_syslog_variables";
ini_set('anything', 'something');

// invalid
ini_set('define_syslog_variables', true);
ini_set("define_syslog_variables", true);
ini_set(
	"define_syslog_variables"
	,
	true
		);
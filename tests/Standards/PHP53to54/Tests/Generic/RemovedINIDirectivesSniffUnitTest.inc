<?php

// valid
echo "define_syslog_variables";
php_ini_set('anything', 'something');

// invalid
php_ini_set('define_syslog_variables', true);
php_ini_set("define_syslog_variables", true);
php_ini_set(
	"define_syslog_variables"
	,
	true
		);
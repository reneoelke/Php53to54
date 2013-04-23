<?php

// valid
echo "define_syslog_variables";
ini_set('anything', 'define_syslog_variables');
class MyClass {
    public function ini_set($var = 'safe_mode') {}
}
MyClass::ini_set('safe_mode');

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
// checklist
ini_set('magic_quotes_runtime', true);
ini_set('magic_quotes_sybase', true);
ini_set('highlight.bg', true);
ini_set('session.bug_compat_42', true);
ini_set('session.bug_compat_warn', true);
ini_set('y2k_compliance', true);
ini_set('short_open_tag', true);

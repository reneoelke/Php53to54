<?php

// valid
echo "safe_mode";
ini_get('anything', 'safe_mode');

class MyClass {
	public function ini_get($var = 'safe_mode') {}
}
MyClass::ini_get('safe_mode');
$ini_get = function($str) {};
$ini_get('safe_mode');
ini_set('safe_mode');
var_dump('' . 3 + ini_set('safe_mode_allowed_env_vars', true));

// invalid
ini_get("safe_mode", true);
ini_get(
    (string)
    /* long comment */
    "safe_mode"
	,
	true
);
// checklist
ini_get('safe_mode', true);
ini_get('safe_mode_gid', true);
ini_get('safe_mode_include_dir', true);
ini_get('safe_mode_exec_dir', true);
ini_get('safe_mode_allowed_env_vars', true);
ini_get('safe_mode_protected_env_vars', true);

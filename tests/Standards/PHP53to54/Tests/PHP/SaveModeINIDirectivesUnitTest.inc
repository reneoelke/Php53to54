<?php

// Valid
echo "safe_mode";
$var="ini_get('save_mode')";

// invalid
ini_get('safe_mode');
if (ini_get('safe_mode') == true) {
	
}

class {
	public function ini_get($var = 'safe_mode') {
		
	}
}


var_dump(''. + 3 ini_set('safe_mode_allowed_env_vars'));
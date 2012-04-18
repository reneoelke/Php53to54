<?php

// valid stuff
class JsonSerializable {
	
}

// invalid stuff
interface JsonSerializable {
	
}

namespace app {
	
	interface JsonSerializable {
		
	}
}
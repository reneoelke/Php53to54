<?php

// valid calls
while($i = 0) {
	continue;
}

for($i = 0; $i < 100; $i++) {
	break
		;
}

for($i = 0; $i < 100; $i++) {
	break 99 + 3
		;
}

for($i = 0; $i < 100; $i++) {
	break (99 + 3)
		;
}

// invalid calls
for($i = 0; $i < 100; $i++) {
	break $i;
}

for($i = 0; $i < 100; $i++) {
	continue ($i + 3);
}

for($i = 0; $i < 100; $i++) {
	continue getContinue();
}

for($i = 0; $i < 100; $i++) {
	continue $object->getContinue();
}

for($i = 0; $i < 100; $i++) {
	continue staticObject::getContinue();
}

for($i = 0; $i < 100; $i++) {
	break (3 * $i);
}
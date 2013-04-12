<?php

// valid calls
while($i = 0) {
	continue;
}

for($i = 0; $i < 100; $i++) {
	break;
}

for($i = 0; $i < 100; $i++) {
	continue (99);
    continue (
    /* comment */ 99 # 1234
    );
	break '3';
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

do { break 1+2; } while(false);
do { break 0; } while(false);
do { continue 'a'; } while(false);
do { continue 1.0; } while(false);
do { continue (float) 1; } while(false);
do { continue true; } while(false);

<?php

// invalid calls
echo hash_file ('salsa10', 'gamma', "beta", ('something'));

echo hash ($algorithm);

sprintf('%s', 'test'.hash('salsa20'));

echo "Teststring".hash_file('no-match').'aslk';
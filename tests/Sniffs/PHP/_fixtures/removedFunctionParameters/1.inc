<?php

// valid calls
echo "Teststring".hash_file('no-match').'aslk';

echo hash_file('no-match', 'gamma', 'beta', 'salsa10');

echo hash ($algorithm);

// invalid calls
echo hash_file ('salsa10', 'gamma', "beta", ('something'));

sprintf('%s', 'test'.hash('salsa20'));

hash(
    /* comment */
    'salsa10',
    $var
);

// checklist
hash_file('salsa10');
hash_hmac_file('salsa10');
hash_hmac('salsa10');
hash_init('salsa10');
hash('salsa10');
hash_file('salsa20');
hash_hmac_file('salsa20');
hash_hmac('salsa20');
hash_init('salsa20');
hash('salsa20');

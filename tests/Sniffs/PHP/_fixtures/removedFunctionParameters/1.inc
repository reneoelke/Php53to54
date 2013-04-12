<?php

// invalid calls
echo hash_file ('salsa10', 'gamma', "beta", ('something'));

echo hash ($algorithm);

sprintf('%s', 'test'.hash('salsa20'));

echo "Teststring".hash_file('no-match').'aslk';

echo hash_file('no-match', 'gamma', 'beta', 'salsa10');

// checklist
        'hash_file' => array('/salsa[1-2]0/'),
        'hash_hmac_file' => array('/salsa[1-2]0/'),
        'hash_hmac' => array('/salsa[1-2]0/'),
        'hash_init' =>array('/salsa[1-2]0/'),
        'hash' => array('/salsa[1-2]0/'),

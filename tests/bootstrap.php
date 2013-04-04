<?php

// require abstract test case
require_once __DIR__ . '/AbstractPhpcsTestCase.php';

if (file_exists(__DIR__ . '/../vendor/bin/phpcs')) {
    // default to composer installed phpcs
    AbstractPhpcsTestCase::$phpcsBinary = __DIR__ . '/../vendor/bin/phpcs';
} else {
    // fall back to system phpcs (*nix only)
    AbstractPhpcsTestCase::$phpcsBinary = trim(`which phpcs 2>/dev/null`);
}

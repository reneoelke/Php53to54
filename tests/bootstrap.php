<?php

// require abstract test case
require_once __DIR__ . '/AbstractPhpcsTestCase.php';

if (file_exists(__DIR__ . '/../vendor/bin/phpcs')) {
    // default to composer phpcs
    AbstractPhpcsTestCase::$phpcsBinary = __DIR__ . '/../vendor/bin/phpcs';
} else {
    // fall back to system phpcs
    AbstractPhpcsTestCase::$phpcsBinary = `which phpcs 2>/dev/null`;
}

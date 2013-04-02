<?php

require_once __DIR__ . '/AbstractSniffTest.php';

if (file_exists(__DIR__ . '/../vendor/bin/phpcs')) {
    AbstractSniffTest::$phpcsBinary = __DIR__ . '/../vendor/bin/phpcs';
} else {
    // fall back to system phpcs
    AbstractSniffTest::$phpcsBinary = `which phpcs`;
    AbstractSniffTest::$useStandardPath = true;
}

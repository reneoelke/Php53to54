<?php

namespace Sniffs\Generic;

/**
 * @group ForbiddenFunctionNames
 * @group PHP
 *
 */
class ForbiddenFunctionNamesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('php53to54.PHP.ForbiddenFunctionNames');
    protected $defaultType = "php53to54.PHP.ForbiddenFunctionNames";

    protected $errors = array('19:5');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        for ($i = 31; $i < 56; $i++) {
            $this->errors[$i] = $i .':10';
        }
        $this->fixture = __DIR__ . '/_fixtures/forbiddenFunctionNames/1.inc';
        return parent::fixtureSniffProvider();
    }
}

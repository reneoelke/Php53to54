<?php

namespace Sniffs\Generic;

/**
 * @group RemovedFunctionParameters
 * @group PHP
 *
 */
class RemovedFunctionParametersTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.PHP.RemovedFunctionParameters');
    protected $defaultType = "Php53to54.PHP.RemovedFunctionParameters";

    protected $errors = array('6:6', '11:6', '13:22', '15:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        for ($i = 22; $i < 32; $i++) {
            $this->errors[$i] = $i .':1';
        }
        $this->fixture = __DIR__ . '/_fixtures/removedFunctionParameters/1.inc';
        return parent::fixtureSniffProvider();
    }
}

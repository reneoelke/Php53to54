<?php

namespace Sniffs\Generic;

/**
 * @group DeprecatedFunctions
 * @group SNMP
 *
 */
class DeprecatedFunctionsTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.SNMP.DeprecatedFunctions');
    protected $defaultType = "Php53to54.SNMP.DeprecatedFunctions.Deprecated";

    protected $warnings = array('21:1', '23:19', '25:9', '31:16');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/1.inc';
        for ($i=36; $i < 60; $i++) {
            $this->warnings[$i] = $i . ':1';
        }
        $fixtures = parent::fixtureSniffProvider();

        return $fixtures;
    }
}

<?php

namespace Sniffs\Generic;

/**
 * @group CallTimePassByReference
 * @group Functions
 *
 */
class CallTimePassByReferenceTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.Functions.CallTimePassByReference');
    protected $defaultType = "Php53to54.Functions.CallTimePassByReference.NotAllowed";

    protected $errors = array('41:13', '42:4', '43:13', '44:16', '45:10', '47:18', '50:15', '52:5');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/1.inc';
        $fixtures = parent::fixtureSniffProvider();

        return $fixtures;
    }
}

<?php

namespace Sniffs\Generic;

/**
 * @group ForbiddenInterfaceNames
 * @group Generic
 *
 */
class ForbiddenInterfaceNamesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Generic.ForbiddenInterfaceNames');
    protected $defaultType = "PHP53to54.Generic.ForbiddenInterfaceNames.invalidInterfaceName";

    protected $errors = array('4:1', '6:1', '8:1', '10:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/forbiddenInterfaceName/invalid.php';
        $fixtures = parent::fixtureSniffProvider();

        // second file is supposed to be valid
        $this->fixture = __DIR__ . '/_fixtures/forbiddenInterfaceName/valid.php';
        $fixtures[] = array($this->fixture, $this->standard, $this->sniffs, array(), array());

        return $fixtures;
    }
}

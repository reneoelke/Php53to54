<?php

namespace Sniffs\Generic;

/**
 * @group ForbiddenClassNames
 * @group Generic
 *
 */
class ForbiddenClassNamesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Generic.ForbiddenClassNames');
    protected $defaultType = "PHP53to54.Generic.ForbiddenClassNames.forbiddenClassname";

    protected $errors = array('4:1', '6:10', '8:11', '10:7', '12:1', '13:1', '14:1', '15:1', '16:1', '17:1', '18:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/forbiddenClassName/invalid.inc';
        $fixtures = parent::fixtureSniffProvider();

        // second file is supposed to be valid
        $this->fixture = __DIR__ . '/_fixtures/forbiddenClassName/valid.inc';
        $fixtures[] = array($this->fixture, $this->standard, $this->sniffs, array(), array());

        return $fixtures;
    }
}

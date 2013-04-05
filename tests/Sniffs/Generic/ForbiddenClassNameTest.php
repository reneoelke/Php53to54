<?php

namespace Sniffs\Generic;

class ForbiddenClassNameTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Generic.ForbiddenClassNames');
    protected $defaultType = "PHP53to54.Generic.ForbiddenClassNames.forbiddenClassname";

    protected $errors = array('4:1', '6:10', '8:11', '10:7');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/forbiddenClassName/invalid.php';
        $fixtures = parent::fixtureSniffProvider();

        // second file is supposed to be valid
        $this->fixture = __DIR__ . '/_fixtures/forbiddenClassName/valid.php';
        $fixtures[] = array($this->fixture, $this->standard, $this->sniffs, array(), array());

        return $fixtures;
    }
}

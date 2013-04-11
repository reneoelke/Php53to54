<?php

namespace Sniffs\Generic;

/**
 * @group Functions
 * @group Deprecated
 *
 */
class FunctionsTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Deprecated.Functions');
    protected $defaultType = "PHP53to54.Deprecated.Functions.Deprecated";

    protected $errors = array('9:1', '10:1', '11:1', '12:1', '13:1', '14:1', '15:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/functions/1.inc';
        $fixtures = parent::fixtureSniffProvider();

        $this->fixture = __DIR__ . '/_fixtures/valid.inc';
        $fixtures[] = array($this->fixture, $this->standard, $this->sniffs, array(), array());

        return $fixtures;
    }
}

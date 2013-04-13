<?php

namespace Sniffs\Generic;

/**
 * @group FunctionAliases
 * @group Deprecated
 *
 */
class FunctionAliasesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.Deprecated.FunctionAliases');
    protected $defaultType = "Php53to54.Deprecated.FunctionAliases.Deprecated";

    protected $errors = array('12:1', '13:1', '14:1', '15:1', '16:1', '17:1', '18:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/functionAliases/1.inc';
        $fixtures = parent::fixtureSniffProvider();

        $this->fixture = __DIR__ . '/_fixtures/valid.inc';
        $fixtures[] = array($this->fixture, $this->standard, $this->sniffs, array(), array());

        return $fixtures;
    }
}

<?php

namespace Sniffs\Extensions;

/**
 * @group SQLiteFunctionNames
 * @group Extensions
 * @group SQLite
 *
 */
class SQLiteFunctionNamesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Extensions.SQLiteFunctions');
    protected $defaultType = "PHP53to54.Extensions.SQLiteFunctions.Deprecated";

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/sqlite/function.inc';
        for ($i=15; $i < 55; $i++) {
            $this->errors[$i] = $i . ':1';
        }
        $fixtures = parent::fixtureSniffProvider();

        return $fixtures;
    }
}

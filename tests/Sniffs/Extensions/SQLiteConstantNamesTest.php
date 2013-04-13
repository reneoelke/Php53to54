<?php

namespace Sniffs\Extensions;

/**
 * @group SQLiteConstantNames
 * @group Extensions
 * @group SQLite
 *
 */
class SQLiteConstantNamesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.Extensions.SQLiteConstants');
    protected $defaultType = "Php53to54.Extensions.SQLiteConstants";

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/sqlite/constant.inc';
        for ($i=10; $i < 41; $i++) {
            $this->errors[$i] = $i . ':1';
        }
        $fixtures = parent::fixtureSniffProvider();

        return $fixtures;
    }
}

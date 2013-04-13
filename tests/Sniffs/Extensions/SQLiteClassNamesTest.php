<?php

namespace Sniffs\Extensions;

/**
 * @group SQLiteClassNames
 * @group Extensions
 * @group SQLite
 *
 */
class SQLiteClassNamesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('php53to54.Extensions.SQLite');
    protected $defaultType = "php53to54.Extensions.SQLite";

    protected $errors = array('4:11', '5:11', '6:20', '7:31', '9:14', '10:14', '11:5', '15:6', '16:6', '17:6');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/sqlite/class.inc';
        $fixtures = parent::fixtureSniffProvider();

        return $fixtures;
    }
}

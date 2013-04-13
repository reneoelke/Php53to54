<?php

namespace Sniffs\Generic;

/**
 * @group PutenvTZ
 * @group PHP
 *
 */
class PutenvTZTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.PHP.PutenvTZ');
    protected $defaultType = "Php53to54.PHP.PutenvTZ.TZ";

    protected $errors = array('9:1', '12:1', '13:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/putenv/tz.inc';
        return parent::fixtureSniffProvider();
    }
}

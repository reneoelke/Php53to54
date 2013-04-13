<?php

namespace Sniffs\Generic;

/**
 * @group RemoteUser
 * @group PHP
 *
 */
class RemoteUserTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.PHP.RemoteUser');
    protected $defaultType = "Php53to54.PHP.RemoteUser";

    protected $warnings = array('9:20', '10:15', '11:10', '12:8');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/remoteUser/1.inc';
        return parent::fixtureSniffProvider();
    }
}

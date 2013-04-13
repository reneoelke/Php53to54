<?php

namespace Sniffs\Generic;

/**
 * @group RemovedIniDirectives
 * @group Generic
 *
 */
class RemovedIniDirectivesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('php53to54.Generic.RemovedINIDirectives');
    protected $defaultType = "php53to54.Generic.RemovedINIDirectives.INIDirectiveRemoved";

    protected $errors = array('12:1', '13:1', '14:1', '22:1', '23:1', '24:1', '25:1', '26:1', '27:1', '28:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/removedIniDirectives/1.inc';
        return parent::fixtureSniffProvider();
    }
}

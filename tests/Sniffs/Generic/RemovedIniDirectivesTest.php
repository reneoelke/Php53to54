<?php

namespace Sniffs\Generic;

/**
 * @group RemovedIniDirectives
 * @group Generic
 *
 */
class RemovedIniDirectivesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Generic.RemovedINIDirectives');
    protected $defaultType = "PHP53to54.Generic.RemovedINIDirectives.INIDirectiveRemoved";

    protected $errors = array('8:1', '9:1', '10:1', '18:1', '19:1', '20:1', '21:1', '22:1', '23:1', '24:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/removedIniDirectives/1.php';
        return parent::fixtureSniffProvider();
    }
}

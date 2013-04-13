<?php

namespace Sniffs\Generic;

/**
 * @group INIShortOpenTags
 * @group PHP
 *
 */
class INIShortOpenTagsTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.PHP.INIShortOpenTags');
    protected $defaultType = "Php53to54.PHP.INIShortOpenTags";

    protected $warnings = array('12:1', '13:1', '14:1', '18:5');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/iniDirectives/shortOpenTags.inc';
        return parent::fixtureSniffProvider();
    }
}

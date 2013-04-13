<?php

namespace Sniffs\Generic;

/**
 * @group RemovedMagicQuotes
 * @group PHP
 *
 */
class RemovedMagicQuotesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.PHP.RemovedMagicQuotes');
    protected $defaultType = "Php53to54.PHP.RemovedMagicQuotes.Deprecated";

    protected $warnings = array('9:1', '11:6', '14:1', '15:1', '16:1');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/removedMagicQuotes/1.inc';
        return parent::fixtureSniffProvider();
    }
}

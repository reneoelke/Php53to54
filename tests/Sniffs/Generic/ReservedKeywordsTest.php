<?php

namespace Sniffs\Generic;

/**
 * @group ReservedKeywords
 * @group Generic
 *
 */
class ReservedKeywordsTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Generic.ReservedKeywords');
    protected $defaultType = "PHP53to54.Generic.ReservedKeywords.unknown";

    protected $errors = array('4:19', '5:7', '9:21', '13:10');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/reservedKeywords/1.php';
        return parent::fixtureSniffProvider();
    }
}
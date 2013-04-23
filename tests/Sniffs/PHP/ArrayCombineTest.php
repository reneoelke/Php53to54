<?php

namespace Sniffs\Generic;

/**
 * @group ArrayCombine
 * @group PHP
 *
 */
class ArrayCombineTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.PHP.ArrayCombine');
    protected $defaultType = "Php53to54.PHP.ArrayCombine.ArrayCombineReturnValueChanged";

    protected $warnings = array('10:1', '11:5', '12:11', '14:10');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        $this->fixture = __DIR__ . '/_fixtures/iniDirectives/safeMode.inc';
        return parent::fixtureSniffProvider();
    }
}

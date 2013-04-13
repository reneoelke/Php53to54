<?php

namespace Sniffs\Generic;

/**
 * @group ForbiddenParameter
 * @group PHP
 *
 */
class ForbiddenParameterTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('Php53to54.PHP.ForbiddenParameter');
    protected $defaultType = "Php53to54.PHP.ForbiddenParameter";

    protected $errors = array('13:1', '14:4', '15:1', '24:14', '27:1', '29:13');


    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        for ($i = 32; $i < 42; $i++) {
            $this->errors[$i] = $i .':1';
        }
        $this->fixture = __DIR__ . '/_fixtures/forbiddenParameter/1.inc';
        return parent::fixtureSniffProvider();
    }
}

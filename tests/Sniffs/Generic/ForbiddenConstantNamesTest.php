<?php

namespace Sniffs\Generic;

/**
 * @group ForbiddenConstantNames
 * @group Generic
 *
 */
class ForbiddenConstantNamesTest extends \AbstractPhpcsTestCase
{
    protected $sniffs = array('PHP53to54.Generic.ForbiddenConstantNames');
    protected $defaultType = "PHP53to54.Generic.ForbiddenConstantNames.invalidConstantName";

    protected $errors = array('5:8', '10:9', '13:2');
    protected $warnings = array('8:9' => 'PHP53to54.Generic.ForbiddenConstantNames.possibleInvalidConstantName');

    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        for ($i = 17; $i < 94; $i++) {
            $this->errors[$i-14] = $i .':8';
        }
        $this->fixture = __DIR__ . '/_fixtures/forbiddenConstantName/1.php';
        $fixtures[] = array($this->fixture, $this->standard, $this->sniffs, $this->errors, $this->warnings);
        $this->fixture = __DIR__ . '/_fixtures/forbiddenConstantName/2.php';
        $fixtures[] = array($this->fixture, $this->standard, $this->sniffs, array('7:8', '12:9', '15:2'), array());

        return $fixtures;
    }
}

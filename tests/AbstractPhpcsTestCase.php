<?php

/**
 * Compares phpcs report on fixtures against expected report.
 *
 */
abstract class AbstractPhpcsTestCase extends PHPUnit_Framework_TestCase
{
    /** @var string */
    public static $phpcsBinary;

    /** @var string */
    protected $standard;

    /** @var string */
    protected $fixture;

    /** @var string */
    protected $defaultType;

    /** @var array */
    protected $sniffs = array();

    /** @var array */
    protected $warnings = array();

    /** @var array */
    protected $errors = array();

    /** @var integer */
    protected $defaultSeverity = 5;

    /**
     *
     * @param array $list
     */
    protected function fixtureExpandErrorList(array &$list)
    {
        foreach ($list as $k => &$v) {
            if (is_int($k)) {
                $list[$v] = array($this->defaultType, $this->defaultSeverity);
                unset($list[$k]);
                continue;
            }
            switch (gettype($v)) {
                case 'integer':
                case 'boolean':
                    $v = $this->defaultType;
                case 'string':
                    $v = array($v, $this->defaultSeverity);
                    break;
                case 'array':
                    if (!isset($v[1])) {
                        $v[1] = $this->defaultSeverity;
                    }
                    break;
                default:
            }
        }
    }

    /**
     *
     * For each fixture a file './_fixtures/FIXTURE_NAME.php' is tested against
     * the phpcs binary with getStandardName() and sniffs from getSniffNames().
     * The report is matched against the second value.
     *
     * @return array
     */
    public function fixtureSniffProvider()
    {
        $fixtures = array();
        if ($this->fixture) {
            $fixtures[] = array(
                $this->fixture,
                $this->standard,
                $this->sniffs,
                $this->errors,
                $this->warnings,
            );
        }

        return $fixtures;
    }

    /** {@inheritdoc} */
    public function setUp()
    {
        if (!self::$phpcsBinary) {
            $this->markTestSkipped('No phpcs binary provided.');
        }
    }

    /**
     * @dataProvider fixtureSniffProvider
     *
     * @param string $fixture  path to fixture
     * @param string $standard phpcs standard name
     * @param array  $sniffs   sniff names, or empty for all sniffs
     * @param array  $errors   expected errors
     * @param array  $warnings expected warnings
     */
    public function testFixtureSniff($fixture, $standard, $sniffs, $errors, $warnings)
    {
        // prepare and get report
        $phpcs = self::$phpcsBinary;
        $standard = escapeshellarg($standard);
        if ($sniffs) {
            $sniffs = '--sniffs=' . escapeshellarg(implode(',', $sniffs));
        } else {
            $sniffs = '';
        }
        $fixture = escapeshellarg($fixture);
        $xml = `$phpcs --standard=$standard $sniffs --report=xml $fixture`;

        $xml = @simplexml_load_string($xml);
        // assert that a report was generated
        $this->assertNotEmpty($xml, 'Could not verify phpcs xml report.');

        // test warnings
        $reported = array();
        $this->fixtureExpandErrorList($warnings);
        foreach ($xml->xpath('//warning') as $element) {
            $id = ((int) $element['line']) . ':' . ((int) $element['column']);
            $reported[$id] = array((string) $element['source'], (int) $element['severity']);
        }
        $this->assertEquals($warnings, $reported, 'Mismatch between expected and reported warnings.');

        // test errors
        $reported = array();
        $this->fixtureExpandErrorList($errors);
        foreach ($xml->xpath('//error') as $element) {
            $id = ((int) $element['line']) . ':' . ((int) $element['column']);
            $reported[$id] = array((string) $element['source'], (int) $element['severity']);
        }
        $this->assertEquals($errors, $reported, 'Mismatch between expected and reported errors.');
    }
}

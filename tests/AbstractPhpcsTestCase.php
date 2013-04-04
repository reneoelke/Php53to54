<?php

/**
 * Compares phpcs report on fixtures against expected report.
 *
 */
abstract class AbstractPhpcsTestCase extends PHPUnit_Framework_TestCase
{
    /** @var string */
    public static $phpcsBinary;

    /**
     *
     * For each fixture a file './_fixtures/FIXTURE_NAME.php' is tested against
     * the phpcs binary with getStandardName() and sniffs from getSniffNames().
     * The report is matched against the second value.
     *
     * @return array
     */
    abstract public function fixtureSniffProvider();

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
            $sniffs = '--sniff=' . escapeshellarg(implode(',', $sniffs));
        } else {
            $sniffs = '';
        }
        $fixture = escapeshellarg($fixture);
        $xml = `$phpcs --standard=$standard $sniffs --report=xml $fixture`;

        $xml = @simplexml_load_string($xml);
        // assert that a report was generated
        $this->assertNotEmpty($xml);

        // test warnings
        $reported = array();
        foreach ($xml->xpath('//warning') as $element) {
            $reported[] = array((int) $element['line'], (int) $element['column'], (string) $element['source'], (int) $element['severity']);
        }
        $this->assertEquals($warnings, $reported, 'Mismatch between expected and reported warnings.');

        // test errors
        $reported = array();
        foreach ($xml->xpath('//error') as $element) {
            $reported[] = array((int) $element['line'], (int) $element['column'], (string) $element['source'], (int) $element['severity']);
        }
        $this->assertEquals($errors, $reported, 'Mismatch between expected and reported errors.');
    }
}

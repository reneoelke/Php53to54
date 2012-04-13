<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * CLASS PHP53to54_Tests_AbstractSniffUnitTest
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
abstract class PHP53to54_Tests_AbstractSniffUnitTest extends PHPUnit_Framework_TestCase
{	
	public function setUp()
    {
		$this->fixture = new PHP_CodeSniffer();
    }

	protected function processFile($filename, $standard =  null, $sniff = null)
	{
		// autodetect standard and sniff if not passed
		if ($standard == null) {
			$standard = realpath(__DIR__.'/../../Standards/PHP53to54');
		}
		if ($sniff == null) {
			$sniff = str_replace('_Tests_', '_Sniffs_', substr(get_class($this), 0, -8)).'Sniff';
		}
		try {
			$this->fixture->process(array(), $standard, array($sniff));
			$this->fixture->setIgnorePatterns(array());
			$this->fixture->processFile($filename);
			$this->fixture->processMulti();
		} catch (Exception $e) {
			$this->fail('An unexpected exception has been caught: '.$e->getMessage());
		}
		$files = $this->fixture->getFiles();
		$failureMessages = array();
		foreach($files as $file) {
			$failureMessages = array_merge($failureMessages, $this->generateFailureMessage('warning', $this->getWarningList(), $file->getWarnings()));
			$failureMessages = array_merge($failureMessages, $this->generateFailureMessage('error', $this->getErrorList(), $file->getErrors()));
		}
		if (!empty($failureMessages)) {
			$this->fail(implode(PHP_EOL, $failureMessages));
		}
		return true;
	}
	
	protected function generateFailureMessage($severity, $expectedErrorsCountPerLine, $actualErrors)
	{
		$messages = array();
		foreach($actualErrors as $line => $lineErrors) {
			$actualErrorCount = count($lineErrors);
			if (!isset($expectedErrorsCountPerLine[$line])) {
				$messages[] = sprintf('[LINE %d] Expected 0 %ss but found %d', $line, $severity, $actualErrorCount);
				break;
			}
			$expectedErrorCount = $expectedErrorsCountPerLine[$line];
			if ($expectedErrorCount !== $actualErrorCount) {
				$messages[] = sprintf('[LINE %d] Expected %d %ss but found %d', $line, $expectedErrorCount, $severity, $actualErrorCount);
				break;
			}
		}
		return $messages;
	}
}
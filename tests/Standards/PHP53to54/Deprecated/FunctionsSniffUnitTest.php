<?php

/**
 * Unit test class for Deprecated/Functions sniff.
 *
 * @group PHP53to54
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Tests_Deprecated_FunctionsSniffUnitTest extends PHP53to54_Tests_AbstractSniffUnitTest
{
	public function testProcess()
	{
		require_once __DIR__.'/../../../../Standards/PHP53to54/Sniffs/Deprecated/FunctionsSniff.php';
		$this->processFile(__DIR__.'/FunctionsSniffUnitTest.inc');
	}
	
	/**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @return array(int => int)
     */
	public function getErrorList()
	{
		return array();
	}
	
	/**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array(int => int)
     */
	public function getWarningList()
	{
        return array(
			3 => 2,
			5 => 1,
		);
    }
}
<?php

/**
 * Unit test class for PHP/BreakContinueVarSyntaxSniff sniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */

/**
 * Unit test class for PHP/BreakContinueVarSyntaxSniff sniff.
 *
 * @group PHP53to54
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */
class PHP53to54_Tests_PHP_BreakContinueVarSyntaxSniffUnitTest extends AbstractSniffUnitTest
{
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
		return array(
			24 => 1,
			29 => 1,
			34 => 1,
			38 => 1,
			42 => 1,
			46 => 1,
			50 => 1,
			54 => 1,
		);
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
		);
    }
}
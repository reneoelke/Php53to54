<?php

// loading classes for usage as standalone standard
if (!class_exists('PHP53to54_AbstractSniff')) {
	require __DIR__.'/../../AbstractSniff.php';
}
if (!class_exists('PHP53to54_Sniffs_PHP_RemovedFunctionParametersSniff')) {
	require __DIR__.'/RemovedFunctionParametersSniff.php';
}

/**
 * putenv TZ Sniff
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
 * putenv TZ sniff
 * 
 * The TZ environment variable is not longer checked by the date/time extension
 * and thus this searches for calls to putenv that try to set TZ.
 *
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */
class PHP53to54_Sniffs_PHP_PutenvTZSniff extends
	PHP53to54_Sniffs_PHP_RemovedFunctionParametersSniff
{
	/**
	 * A list of tokenizers this sniff supports.
	 *
	 * @var array
	 */
	public $supportedTokenizers = array(
		'PHP',
	);
	
	/**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
	public function register()
	{
		return array(
			T_STRING,
		);
	}
	
	/**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     * @return void
     */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		
		if (strtolower($token['content']) !== 'putenv') {
			return true;
		}
		// find first string param
		if (!($firstParameterPtr = $phpcsFile->findNext(array(T_DOUBLE_COLON), $stackPtr + 2, null, true))) {
			return true;
		}
		$firstParameter = substr($tokens[$firstParameterPtr]['content'], 1, -1);
		if (preg_match('/^TZ=/', $firstParameter)) {
			$phpcsFile->addError('TZ environment variable not longer checked', $stackPtr, 'TZ');
		}
		return true;
	}
}
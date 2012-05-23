<?php

/**
 * Search for usage of $_SERVER['REMOTE_USAGE']
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
 * Search for usage of $_SERVER['REMOTE_USAGE']
 * 
 * This sniff searches for the usage of $_SERVER['REMOTE_USER'] or a variable or
 * string that is exactly 'REMOTE_USER' which is not available in PHP 5.4
 * anymore.
 *
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */
class PHP53to54_Sniffs_PHP_RemoteUserSniff
	extends PHP53to54_AbstractSniff
	implements PHP_CodeSniffer_Sniff
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
			T_CONSTANT_ENCAPSED_STRING,
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
		$content = substr($token['content'], 1, -1);
		if ($content == 'REMOTE_USER') {
			$phpcsFile->addWarning('REMOTE_USER is deprecated as SAFE_MODE was removed', $stackPtr);
		}
		return true;
	}
}
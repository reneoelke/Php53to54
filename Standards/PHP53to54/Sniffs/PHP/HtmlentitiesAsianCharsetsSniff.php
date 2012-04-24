<?php

/**
 * Removed INI Directives Sniff
 *
 * PHP version 5
 *
 * @category  PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */

/**
 * Removed INI Directives Sniff
 * 
 * Search for calls to htmlentities with asian character sets which will lead to
 * a E_STRICT error message.
 * 
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_HtmlentitiesAsianCharsetsSniff
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
	
	// from http://en.wikipedia.org/wiki/Character_set
	protected $invalidEncodings = array(
		'BIG5',
		'GB2312',
		'GB2312',
		'BIG5-HKSCS',
		'Shift_JIS',
		'EUC-JP',
	);
	
	/**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
	public function register()
	{
		return array(
			T_STRING
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
		
		// check function name
		if (strtolower($token['content']) !== 'htmlentities') {
			return true;
		}
		// check if it’s a function call
		if (!$this->isFunction($phpcsFile, $stackPtr) || !$this->isFunctionCall($phpcsFile, $stackPtr)) {
			return true;
		}
		// check if third parameter defined
		$thirdParameter = $this->getFunctionCallParameterByIndex($phpcsFile, $stackPtr, 2);
		if (!$thirdParameter || $thirdParameter['code'] !== T_CONSTANT_ENCAPSED_STRING) {
			return true;
		}
		$thirdParameterValue = strtoupper(substr($thirdParameter['content'], 1, -1));
		if (in_array($thirdParameterValue, $this->invalidEncodings)) {
			$phpcsFile->addError('htmlentites throws E_STRICT with asian charsets', $stackPtr, 'ErrorAsianCharsets');
			return true;
		}
		return true;
	}
}
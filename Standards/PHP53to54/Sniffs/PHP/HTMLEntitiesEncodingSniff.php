<?php

/**
 * Changed htmlentities default Character Set
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
 * Changed htmlentities default Character Set
 * 
 * Search for calls to htmlentities with no third parameter passed which will
 * use utf-8 as default encoding instead of iso in php 5.4.
 * 
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_HtmlentitiesEncodingSniff
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
		// missing third parameter
		if (!$thirdParameter) {
			$phpcsFile->addWarning('default encoding changed from ISO to UTF8', $stackPtr, 'ChangedDefaultCharacterEncoding');
			return true;
		}
		switch($thirdParameter['code']) {
			case T_VARIABLE:
				$phpcsFile->addWarning('default encoding changed from ISO to UTF8', $stackPtr, 'ChangedDefaultCharacterEncoding');
				return true;
				break;
			case T_CONSTANT_ENCAPSED_STRING:
				$stringValue = substr($thirdParameter['content'], 1, -1);
				if (empty($stringValue)) {
					$phpcsFile->addWarning('default encoding changed from ISO to UTF8', $stackPtr, 'ChangedDefaultCharacterEncoding');
				}
				break;
		}
		var_dump($thirdParameter);
		return true;
	}
}
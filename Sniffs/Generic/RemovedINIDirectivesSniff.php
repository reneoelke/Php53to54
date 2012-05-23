<?php

/**
 * Removed INI Directives Sniff
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
 * Removed INI Directives Sniff
 * 
 * Search for calls to php_ini_set which try to change some of the removed
 * php ini directives.
 * 
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */
class PHP53to54_Sniffs_Generic_RemovedINIDirectivesSniff
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
	 * A list of removed INI directives
	 * 
	 * @var array(string)
	 */
	public $names = array();
	
	/**
	 * A list of ini set or get functions which parameters should be checked
	 * 
	 * @var array(string)
	 */
	public $functions = array(
		'ini_set',
	);
	
	/**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
	public function register()
    {
		$this->parseArrayProperty('names');
        return array(T_STRING);
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

		// check function name for reading or writing to the ini
		$functionName = strtolower($token['content']);
		if (!in_array($functionName, $this->functions)) {
			return true;
		}
		// check if it’s a function call
		if (!$this->isFunction($phpcsFile, $stackPtr) || !$this->isFunctionCall($phpcsFile, $stackPtr)) {
			return true;
		}
		$parameters = $this->getFunctionCallParameters($phpcsFile, $stackPtr);
		if (count($parameters) == 0) {
			return true;
		}
		$firstParameter = reset($parameters);
		if ($firstParameter['code'] != T_CONSTANT_ENCAPSED_STRING) {
			return true;
		}
		$iniDirectiveName = substr($firstParameter['content'], 1, -1);
		if (in_array($iniDirectiveName, $this->names)) {
			$this->foundName($phpcsFile, $stackPtr, $iniDirectiveName);
		}
		return true;
	}
	
	/**
	 * Triggered when the first parameter of a ini_set call matches
	 */
	protected function foundName(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $directiveName)
	{
		$message = sprintf('%s was removed in PHP 5.4', $directiveName);
		$phpcsFile->addError($message, $stackPtr, 'INIDirectiveRemoved');
		return true;
	}
}
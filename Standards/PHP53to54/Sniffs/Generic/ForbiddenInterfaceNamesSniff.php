<?php

/**
 * Forbidden Interface Names Sniff
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
 * Forbidden Interface Names Sniff
 * 
 * Search for interfaces that collide with the new classes introduced with php 5.4.
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_Generic_ForbiddenInterfaceNamesSniff
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
	 * A list of removed functions with their parameters associated regular
	 * expression that are not allowed anymore.
	 * 
	 * @var array(string => array(string, [string]))
	 */
	public $names = array();
	
	/**
	 * Turn namespace checking on/off
	 * 
	 * @var boolean
	 */
	public $checkNamespace = true;
	
	public function register()
	{
		$this->parseArrayProperty('names');
		return array(
			T_INTERFACE,
			T_NAMESPACE,
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
		
		$result = true;
		switch($token['code']) {
			case T_NAMESPACE:
				$result = $this->processNamespace($phpcsFile, $stackPtr);
				break;
			case T_INTERFACE:
			default:
				if ($this->checkNamespace && $this->getLastNamespaceForFile($phpcsFile)) {
					return false;
				}
				$result = $this->processInterface($phpcsFile, $stackPtr);
				break;
		}
		return $result;
	}
	
	protected function processInterface(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		
		$interfaceNameToken = $tokens[$phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false)];
		$interfaceName = $interfaceNameToken['content'];
		$names = array_map('strtolower', $this->names);
		
		if (in_array(strtolower($interfaceName), $names)) {
			$phpcsFile->addError(sprintf('%s interface is a reserved interface in PHP 5.4', $interfaceName), $stackPtr);
		}
		return true;
	}
}
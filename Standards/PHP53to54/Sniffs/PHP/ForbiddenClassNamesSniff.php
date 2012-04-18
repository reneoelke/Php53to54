<?php

/**
 * Forbidden Classnames Sniff
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
 * Forbidden Classnames Sniff
 * 
 * Search for classes that collide with the new classes introduced with php 5.4.
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_ForbiddenClassNamesSniff implements PHP_CodeSniffer_Sniff
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
	protected $forbiddenClassnames = array(
		'CallbackFilterIterator',
		'RecursiveCallbackFilterIterator',
		'ReflectionZendExtension',
		'SessionHandler',
		'SNMP',
		'Transliterator',
		'Spoofchecker',
	);
	
	public function register()
	{
		return array(
			T_CLASS,
			T_NAMESPACE,
		);
	}
	
	/**
	 * Cache for storing last namespace names found in files while 
	 * parsing them.
	 * 
	 * @var array(string = string)
	 */
	protected $lastNamespacesPerFile = null;
	
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
		switch ($token['code']) {
			case T_NAMESPACE:
				$result = $this->processNamespace($phpcsFile, $stackPtr);
				break;
			default:
			case T_CLASS:
				// only check classnames if we're in global namespace
				if (!empty($this->lastNamespace)) {
					break;
				}
				$result = $this->processClass($phpcsFile, $stackPtr);
				break;
		}
		return $result;
	}
	
	// @TODO Refactor this because it’s DRY with ForbiddenClassNamesSniff
	protected function getLastNamespaceForFile(PHP_CodeSniffer_File $phpcsFile)
	{
		$filename = $phpcsFile->getFilename();
		if (empty($this->lastNamespacesPerFile[$filename])) {
			return false;
		}
		return $this->lastNamespacesPerFile[$filename];
	}
	
	// @TODO Refactor this because it’s DRY with ForbiddenClassNamesSniff
	protected function processNamespace(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		$namspaceToken = $tokens[$phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false)];
		$this->lastNamespacesPerFile[$phpcsFile->getFilename()] = strtolower($namspaceToken['content']);
		return true;
	}
	
	protected function processClass(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$classnameToken = $tokens[$phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false)];
		$classname = $classnameToken['content'];

		$forbiddenClassnames = array_map('strtolower', $this->forbiddenClassnames);
		if (in_array(strtolower($classname), $forbiddenClassnames)) {
			$phpcsFile->addError(sprintf('%s classname is a reserved classname in PHP 5.4', $classname), $stackPtr);
		}
		return true;
	}
}
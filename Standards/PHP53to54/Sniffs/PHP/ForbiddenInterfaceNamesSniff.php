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

require_once __DIR__.'/RemovedFunctionParametersSniff.php';

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
class PHP53to54_Sniffs_PHP_ForbiddenInterfaceNamesSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * A list of removed functions with their parameters associated regular
	 * expression that are not allowed anymore.
	 * 
	 * @var array(string => array(string, [string]))
	 */
	protected $forbiddenInterfacenames = array(
		'JsonSerializable',
		'SessionHandlerInterface',
	);
	
	public function register()
	{
		return array(
			T_INTERFACE,
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
		$interfaceNameToken = $tokens[$phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false)];
		$interfaceName = $interfaceNameToken['content'];
		$forbiddenInterfaceNames = array_map('strtolower', $this->forbiddenInterfacenames);
		
		if (in_array(strtolower($interfaceName), $forbiddenInterfaceNames)) {
			$phpcsFile->addError(sprintf('%s interface is a reserved interface in PHP 5.4', $interfaceName), $stackPtr);
		}
		return true;
	}
}
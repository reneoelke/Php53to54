<?php

/**
 * CallTimePassByReferenceSniff
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
 * CallTimePassByReferenceSniff
 * 
 * This searches for calls to functions with parameters passes with reference.
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_Functions_CallTimePassByReferenceSniff
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
	
	public function register()
    {
        return array(T_STRING);
    }

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		
		// check if it’s a function call
		if (!$this->isFunction($phpcsFile, $stackPtr) || !$this->isFunctionCall($phpcsFile, $stackPtr)) {
			return;
		}
		// iterate over parameters and check if they passed with &
		$parameterTokens = $this->getFunctionCallParameters($phpcsFile, $stackPtr);
		foreach($parameterTokens as $tmpPtr => $parameterToken) {
			$previousToken = $tokens[$tmpPtr-1];
			if ($parameterToken['code'] != T_VARIABLE) {
				continue;
			}
			if ($previousToken['code'] == T_BITWISE_AND) {
				$phpcsFile->addError('Call-time pass by reference has been removed', $stackPtr);
			}
		}
		return true;
	}
}
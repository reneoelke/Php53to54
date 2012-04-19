<?php

/**
 * Forbidden Function Parameter
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
 * Forbidden Function Parameter
 * 
 * Search for function or closure definitions that use global variable as their
 * parameters.
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_ForbiddenParameterSniff extends PHP53to54_Sniffs_PHP_RemovedFunctionParametersSniff
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
	protected $forbiddenParameterNames = array(
		'$GLOBALS',
		'$_SERVER',
		'$_GET',
		'$_POST',
		'$_SET',
		'$_FILES',
		'$_COOKIE',
		'$_SESSION',
		'$_REQUEST',
		'$_ENV',
	);
	
	public function register()
	{
		return array(
			T_FUNCTION,
			T_CLOSURE,
		);
	}
	
	public function getFunctionDefinitionParameters(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
		if (!isset($tokens[$openBracket]['parenthesis_closer'])) {
			return false;
		}
		$closeBracket = $tokens[$openBracket]['parenthesis_closer'];
		
		$parameters = array();
		$tmpPtr = $openBracket;
		while (($tmpPtr = $phpcsFile->findNext(array(T_VARIABLE), $tmpPtr)) !== false) {
			if ($tmpPtr > $closeBracket) break;
			$parameters[] = $tokens[$tmpPtr];
			$tmpPtr++;
		}
		return $parameters;
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
		$functionNamePtr = $phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false);
		
		$parameterTokens = $this->getFunctionDefinitionParameters($phpcsFile, $functionNamePtr);
		if (!$parameterTokens) {
			return false;
		}
		foreach($parameterTokens as $index => $parameterToken) {
			$variableName = $parameterToken['content'];
			if (!in_array($variableName, $this->forbiddenParameterNames)) {
				continue;
			}
			$phpcsFile->addWarning(sprintf('%s is not a valid function parameter', $variableName), $stackPtr);
		}
		return;
	}
}
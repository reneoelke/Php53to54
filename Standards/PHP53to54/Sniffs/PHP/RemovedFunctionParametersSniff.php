<?php

/**
 * Removed Function Parameters
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
 * Removed Function Parameters
 * 
 * Search for function calls of functions that have invalid parameters.
 * 
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_RemovedFunctionParametersSniff implements PHP_CodeSniffer_Sniff
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
	protected $forbiddenFunctionsParameters = array(
		'hash_file' => array('/salsa[1-2]0/'),
		'hash_hmac_file' => array('/salsa[1-2]0/'),
		'hash_hmac' => array('/salsa[1-2]0/'),
		'hash_init' =>array('/salsa[1-2]0/'),
		'hash' => array('/salsa[1-2]0/'),
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

	public function isFunction(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
		if ($tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
			return false;
		}
		if (isset($tokens[$openBracket]['parenthesis_closer']) === false) {
			return false;
		}
		return true;
	}
	
	public function isFunctionCall(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$search	= PHP_CodeSniffer_Tokens::$emptyTokens;
		$search[] = T_BITWISE_AND;
		$previous = $phpcsFile->findPrevious($search, ($stackPtr - 1), null, true);
		if ($tokens[$previous]['code'] === T_FUNCTION) {
			return false;
		}
		return true;
	}
	
	public function getFunctionCallParameters(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
		$closeBracket = $tokens[$openBracket]['parenthesis_closer'];
		
		$parameters = array();
		$tmpPtr = $openBracket;
		while (($tmpPtr = $phpcsFile->findNext(array(T_CONSTANT_ENCAPSED_STRING, T_VARIABLE), $tmpPtr)) !== false) {
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

		if (!$this->isFunction($phpcsFile, $stackPtr) || !$this->isFunctionCall($phpcsFile, $stackPtr)) {
			return;
		}
		$functionName = strtolower($tokens[$stackPtr]['content']);
		if (!isset($this->forbiddenFunctionsParameters[$functionName])) {
			return;
		}

		$parameterTokens = $this->getFunctionCallParameters($phpcsFile, $stackPtr);
		$parameterRegExps = $this->forbiddenFunctionsParameters[$functionName];
		foreach($parameterTokens as $index => $parameterToken) {
			switch($parameterToken['code']) {
				case T_CONSTANT_ENCAPSED_STRING:
					if (!isset($this->forbiddenFunctionsParameters[$functionName][$index])) {
						continue;
					}
					$regexp = $this->forbiddenFunctionsParameters[$functionName][$index];
					$string = substr($parameterToken['content'], 1, -1);
					if (preg_match($regexp, $string)) {
						$phpcsFile->addError(sprintf('%s function parameter %d value %s is invalid', $functionName, $index, $functionName), $stackPtr);
					}
					break;
				case T_VARIABLE:
					$phpcsFile->addWarning(sprintf('%s function parameter %d is possibly deprecated', $functionName, $index), $stackPtr);
					break;
			}
		}
	}
}
<?php

/**
 * CLASS PHP53to54_Sniffs_Deprecated_FunctionAliasesSniff
 * 
 * This sniff searches for functions that are called with deprecated parameters.
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
	 * A list of removed functions with their parameters associated regular
	 * expression that are not allowed anymore.
	 * 
	 * @var array(string => array(string, [string]))
	 */
	protected $forbiddenFunctionsParameters = array(
		'hash_file' => array('/hash[1-2]0/'),
		'hash_hmac_file' => array('/hash[1-2]0/'),
		'hash_hmac' => array('/hash[1-2]0/'),
		'hash_init' =>array('/hash[1-2]0/'),
		'hash' => array('/hash[1-2]0/'),
	);
	
	/**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
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
		$openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);

        if ($tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
            // Not a function call.
            return;
        }

        if (isset($tokens[$openBracket]['parenthesis_closer']) === false) {
            // Not a function call.
            return;
        }

		// Find the previous non-empty token.
        $search   = PHP_CodeSniffer_Tokens::$emptyTokens;
        $search[] = T_BITWISE_AND;
        $previous = $phpcsFile->findPrevious($search, ($stackPtr - 1), null, true);
        if ($tokens[$previous]['code'] === T_FUNCTION) {
            // It's a function definition, not a function call.
            return;
        }

		$bracketClose = $phpcsFile->findNext(array(T_CLOSE_PARENTHESIS), $stackPtr);

		$function = strtolower($tokens[$stackPtr]['content']);
		$i = $stackPtr;
		while ($tmpPtr = $phpcsFile->findNext(array(T_CONSTANT_ENCAPSED_STRING), $i, $bracketClose)) {
			$parameterToken = $tokens[$tmpPtr];
			$i++;
			$parameters[] = $parameterToken;
			var_dump($parameterToken);
		}
		// var_dump($parameters);
		// foreach($parameters as $parameterToken) {
		// 
		// 		}
	}
}
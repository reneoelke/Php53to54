<?php

/**
 * Continue/Break syntax without variable
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
 * Continue/Break syntax without variable
 * 
 * Searches for break or continue statements that use parameters which is not
 * allowed anymore in PHP 5.4.
 * 
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_BreakContinueVarSyntaxSniff implements PHP_CodeSniffer_Sniff
{
	public function register()
    {
        return array(T_BREAK, T_CONTINUE);
    }

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		// iterate over next tokens and search for hints to variable usage 
		// or method/function calls
		$nextSemicolonToken = $phpcsFile->findNext(T_SEMICOLON, ($stackPtr), null, false);
		if (!$nextSemicolonToken) {
			return false;
		}
		for ($curToken = $stackPtr + 1; $curToken < $nextSemicolonToken; $curToken++) {
			$token = $tokens[$curToken];
			$nextNotEmptyToken = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, $curToken + 1, null, true);
			$nextToken = $tokens[$nextNotEmptyToken];
			
			$staticObjectMethodCall = $token['code'] == T_STRING && $nextToken['code'] == T_DOUBLE_COLON;
			$objectMethodCall = $token['code'] == T_STRING && $nextToken['code'] == T_OBJECT_OPERATOR;
			$functionCall = $token['code'] == T_STRING && $nextToken['code'] == T_OPEN_PARENTHESIS;
			$isVariable = $token['code'] == T_VARIABLE;
			
			if ($staticObjectMethodCall || $objectMethodCall || $functionCall) {
				$phpcsFile->addError('function calls in break/continue statements not supported', $stackPtr);
				break;
			}
			if ($isVariable) {
				$phpcsFile->addError('break/continue with variable is not supported', $stackPtr);
				break;
			}
		}
		return true;
	}
}
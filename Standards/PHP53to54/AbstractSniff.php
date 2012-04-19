<?php

/**
 * AbstractSniff
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
 * AbstractSniff
 * 
 * Jaggers base class for Sniffs that provides methods that can be used in 
 * various Sniffs.
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
abstract class PHP53to54_AbstractSniff
{
	protected function parseArrayProperty($propertyName)
	{
		if (!is_string($this->{$propertyName})) {
			return true;
		}
		$this->{$propertyName} = preg_split('/[\s,\r\n]/', $this->{$propertyName});
		$this->{$propertyName} = array_map('trim', $this->{$propertyName});
		$this->{$propertyName} = array_filter($this->{$propertyName});
		return $this;
	}
	
	/**
	 * Cache for storing last namespace names found in files while 
	 * parsing them.
	 * 
	 * @var array(string = string)
	 */
	protected $lastNamespacesPerFile = null;
	
	protected function getLastNamespaceForFile(PHP_CodeSniffer_File $phpcsFile)
	{
		$filename = $phpcsFile->getFilename();
		if (empty($this->lastNamespacesPerFile[$filename])) {
			return false;
		}
		return $this->lastNamespacesPerFile[$filename];
	}
	
	protected function processNamespace(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		$namspaceToken = $tokens[$phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false)];
		$this->lastNamespacesPerFile[$phpcsFile->getFilename()] = strtolower($namspaceToken['content']);
		return true;
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
			$parameters[$tmpPtr] = $tokens[$tmpPtr];
			$tmpPtr++;
		}
		return $parameters;
	}

}
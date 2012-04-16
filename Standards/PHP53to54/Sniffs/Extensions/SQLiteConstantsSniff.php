<?php

/**
 * SQLite Constants Search
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
 * SQLite Constants Search
 * 
 * @todo create a generic test that searches for the usage of forbidden constants
 * 
 * Searches constants from the SQLite extension that has been removed in PHP 5.4
 * 
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_Extensions_SQLiteConstantsSniff implements PHP_CodeSniffer_Sniff
{
	protected $constants = array(
		'SQLITE_ASSOC',
		'SQLITE_BOTH',
		'SQLITE_NUM',
		'SQLITE_OK',
		'SQLITE_ERROR',
		'SQLITE_INTERNAL',
		'SQLITE_PERM',
		'SQLITE_ABORT',
		'SQLITE_BUSY',
		'SQLITE_LOCKED',
		'SQLITE_NOMEM',
		'SQLITE_READONLY',
		'SQLITE_INTERRUPT',
		'SQLITE_IOERR',
		'SQLITE_NOTADB',
		'SQLITE_CORRUPT',
		'SQLITE_FORMAT',
		'SQLITE_NOTFOUND',
		'SQLITE_FULL',
		'SQLITE_CANTOPEN',
		'SQLITE_PROTOCOL',
		'SQLITE_EMPTY',
		'SQLITE_SCHEMA',
		'SQLITE_TOOBIG',
		'SQLITE_CONSTRAINT',
		'SQLITE_MISMATCH',
		'SQLITE_MISUSE',
		'SQLITE_NOLFS',
		'SQLITE_AUTH',
		'SQLITE_ROW',
		'SQLITE_DONE',
	);
	
	public function register()
    {
        return array(
			T_STRING,
		);
    }

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		$constantName = $token['content'];
		
		// check if constant name is registered in the list of invalid names
		if (!in_array($constantName, $this->constants)) {
			return true;
		}
		
		// check if its a constant definition in a class
		$previousNotEmptyToken = $phpcsFile->findPrevious(PHP_CodeSniffer_Tokens::$emptyTokens, $stackPtr - 1, null, true);
		$previousToken = $tokens[$previousNotEmptyToken];
		if ($previousToken['code'] == T_CONST) {
			return true;
		}
		
		$phpcsFile->addError(sprintf('%s from the sqlite extension is not supported by PHP 5.4 anymore', $token['content']), $stackPtr);
		return true;
	}
}
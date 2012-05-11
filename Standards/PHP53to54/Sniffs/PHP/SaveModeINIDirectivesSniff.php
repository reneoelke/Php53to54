<?php

/**
 * Removed INI Directives Sniff
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
 * Removed INI Directives Sniff
 * 
 * Search for calls to php_ini_set which try to change some of the removed
 * php ini directives.
 * 
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_SaveModeINIDirectivesSniff
	extends PHP53to54_Sniffs_Generic_RemovedINIDirectivesSniff
	implements PHP_CodeSniffer_Sniff
{
	/**
	 * A list of ini set or get functions which parameters should be checked
	 * 
	 * @var array(string)
	 */
	public $functions = array(
		'ini_get',
	);
	
	 /**
	 * A list of removed INI directives
	 * 
	 * @var array(string)
	 */
	public $names = array(
		'safe_mode',
		'safe_mode_gid',
		'safe_mode_include_dir',
		'safe_mode_exec_dir',
		'safe_mode_allowed_env_vars',
		'safe_mode_protected_env_vars',
	);
	
	/**
	 * Triggered when the first parameter of a ini_set call matches
	 */
	protected function foundName(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $directiveName)
	{
		$message = sprintf('%s is part of safe_mode which was removed in PHP 5.4', $directiveName);
		$phpcsFile->addWarning($message, $stackPtr, 'INIDirectiveRemoved');
		return true;
	}
}
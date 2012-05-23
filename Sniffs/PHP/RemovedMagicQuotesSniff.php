<?php

/**
 * RemovedMagicQuotesSniff
 *
 * PHP version 5
 *
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */

/**
 * RemovedMagicQuotesSniff
 * 
 * Search for calls of functions that have something to do with magic_quotes
 *
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */
class PHP53to54_Sniffs_PHP_RemovedMagicQuotesSniff extends Generic_Sniffs_PHP_DeprecatedFunctionsSniff
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
	 * A list of forbidden function names
	 * 
	 * @var array(string => array(string, [string]))
	 */
	protected $forbiddenFunctions = array(
		'get_magic_quotes_runtime' => null,
		'get_magic_quotes_gpc' => null, 
		'set_magic_quotes_runtime' => null,
	);
	
	public $error = false;
}
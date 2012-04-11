<?php
/**
 * CLASS PHP53to54_Sniffs_Deprecated_FunctionsSniff
 * 
 * This sniff searches for functions declared as deprecated (E_DEPRECATED error level).
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_Deprecated_FunctionsSniff extends Generic_Sniffs_PHP_DeprecatedFunctionsSniff
{
	/**
     * A list of deprecated functions with their alternatives.
     *
     * The value is NULL if no alternative exists. IE, the
     * function should just not be used.
     *
     * @var array(string => string|null)
     */
	protected $forbiddenFunctions = array(
		'define_syslog_variables' => null,
		'import_request_variables' => 'consider using extract()',
		'session_is_registered' => 'use $_SESSION',
		'session_register' => 'use $_SESSION',
		'session_unregister' => 'use $_SESSION',
		'mcrypt_generic_end' => null,
		'mysql_list_dbs' => null,
	);

	/**
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = false;
}
<?php

/**
 * SNMP OOP-Only
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
 * SNMP OOP-Only
 * 
 * Checks for calls to snmp_* functions that will return false in PHP 5.4.
 *
 * @todo create own generic deprecatedfunctionsniff that also checks for namespace and can be configured via XML
 * 
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_SNMP_DeprecatedFunctionsSniff extends Generic_Sniffs_PHP_DeprecatedFunctionsSniff
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
     * A list of deprecated functions with their alternatives.
     *
     * The value is NULL if no alternative exists. IE, the
     * function should just not be used.
     *
     * @var array(string => string|null)
     */
	protected $forbiddenFunctions = array(
		'snmp_get_quick_print' => null,
		'snmp_get_valueretrieval' => null,
		'snmp_read_mib' => null,
		'snmp_set_enum_print' => null,
		'snmp_set_oid_numeric_print' => null,
		'snmp_set_oid_output_format' => null,
		'snmp_set_quick_print' => null,
		'snmp_set_valueretrieval' => null,
		'snmp2_get' => null,
		'snmp2_getnext' => null,
		'snmp2_real_walk' => null,
		'snmp2_set' => null,
		'snmp2_walk' => null,
		'snmp3_get' => null,
		'snmp3_getnext' => null,
		'snmp3_real_walk' => null,
		'snmp3_set' => null,
		'snmp3_walk' => null,
		'snmpget' => null,
		'snmpgetnext' => null,
		'snmprealwalk' => null,
		'snmpset' => null,
		'snmpwalk' => null,
		'snmpwalkoid' => null,
	);

	/**
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = true;
}
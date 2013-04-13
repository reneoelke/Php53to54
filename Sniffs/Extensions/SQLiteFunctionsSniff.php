<?php
/**
 * SQLite Functions search
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/Php53to54
 * @since     1.0-beta
 */

namespace Php53to54\Sniffs\Extensions;

/**
 * SQLite Functions search
 *
 * Searches for calls to the SQLite Extension functions that have been removed
 * from the default extensions in PHP 5.4.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/Php53to54
 * @since     1.0-beta
 */
class SQLiteFunctionsSniff extends \Generic_Sniffs_PHP_DeprecatedFunctionsSniff
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
        'sqlite_array_query' => null,
        'sqlite_busy_timeout' => null,
        'sqlite_changes' => null,
        'sqlite_close' => null,
        'sqlite_column' => null,
        'sqlite_create_aggregate' => null,
        'sqlite_create_function' => null,
        'sqlite_current' => null,
        'sqlite_error_string' => null,
        'sqlite_escape_string' => null,
        'sqlite_exec' => null,
        'sqlite_factory' => null,
        'sqlite_fetch_all' => null,
        'sqlite_fetch_array' => null,
        'sqlite_fetch_column_types' => null,
        'sqlite_fetch_object' => null,
        'sqlite_fetch_single' => null,
        'sqlite_fetch_string' => null,
        'sqlite_field_name' => null,
        'sqlite_has_more' => null,
        'sqlite_has_prev' => null,
        'sqlite_key' => null,
        'sqlite_last_error' => null,
        'sqlite_last_insert_rowid' => null,
        'sqlite_libencoding' => null,
        'sqlite_libversion' => null,
        'sqlite_next' => null,
        'sqlite_num_fields' => null,
        'sqlite_num_rows' => null,
        'sqlite_open' => null,
        'sqlite_popen' => null,
        'sqlite_prev' => null,
        'sqlite_query' => null,
        'sqlite_rewind' => null,
        'sqlite_seek' => null,
        'sqlite_single_query' => null,
        'sqlite_udf_decode_binary' => null,
        'sqlite_udf_encode_binary' => null,
        'sqlite_unbuffered_query' => null,
        'sqlite_valid' => null,
    );

    /**
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = true;
}

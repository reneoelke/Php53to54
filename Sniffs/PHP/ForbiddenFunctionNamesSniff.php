<?php

/**
 * Forbidden Function Names
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */

/**
 * Forbidden Function Names
 *
 * Search for definitions of functions that have been added in PHP 5.4.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_PHP_ForbiddenFunctionNamesSniff
extends Generic_Sniffs_PHP_DeprecatedFunctionsSniff
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
        // PHP Core
        'hex2bin' => null,
        'http_response_code' => null,
        'get_declared_traits' => null,
        'getimagesizefromstring' => null,
        'stream_set_chunk_size' => null,
        'socket_import_stream' => null,
        'trait_exists' => null,
        'header_register_callback' => null,
        // SPL
        'class_uses' => null,
        // Session
        'session_status' => null,
        'session_register_shutdown' => null,
        // Mysqli
        'mysqli_error_list' => null,
        'mysqli_stmt_error_list' => null,
        // Libxml
        'libxml_set_external_entity_loader' => null,
        // LDAP
        'ldap_control_paged_result' => null,
        'ldap_control_paged_result_response' => null,
        // Intl
        'transliterator_create' => null,
        'transliterator_create_from_rules' => null,
        'transliterator_create_inverse' => null,
        'transliterator_get_error_code' => null,
        'transliterator_get_error_message' => null,
        'transliterator_list_ids' => null,
        'transliterator_transliterate' => null,
        // Zlib
        'zlib_decode' => null,
        'zlib_encode' => null,
    );

    /**
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = false;
}
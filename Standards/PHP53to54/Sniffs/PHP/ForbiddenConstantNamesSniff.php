<?php

/**
 * Forbidden Constant Names
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
 * Forbidden Constant Names
 * 
 * Search for constant definitions that define constants that have been added in 
 * PHP 5.4.
 *
 * @category PHP
 * @package	PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD Licence
 * @link https://github.com/foobugs/jagger
 */
class PHP53to54_Sniffs_PHP_ForbiddenConstantNamesSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * A list of forbidden constant names.
	 * 
	 * @var array(string => array(string, [string]))
	 */
	protected $forbiddenConstantNames = array(
		// PHP Core:
		'ENT_DISALLOWED',
		'ENT_HTML401',
		'ENT_HTML5',
		'ENT_SUBSTITUTE',
		'ENT_XML1',
		'ENT_XHTML',
		'IPPROTO_IP',
		'IPPROTO_IPV6',
		'IPV6_MULTICAST_HOPS',
		'IPV6_MULTICAST_IF',
		'IPV6_MULTICAST_LOOP',
		'IP_MULTICAST_IF',
		'IP_MULTICAST_LOOP',
		'IP_MULTICAST_TTL',
		'MCAST_JOIN_GROUP',
		'MCAST_LEAVE_GROUP',
		'MCAST_BLOCK_SOURCE',
		'MCAST_UNBLOCK_SOURCE',
		'MCAST_JOIN_SOURCE_GROUP',
		'MCAST_LEAVE_SOURCE_GROUP',

		// Curl:
		'CURLOPT_MAX_RECV_SPEED_LARGE',
		'CURLOPT_MAX_SEND_SPEED_LARGE',
		// LibXML:
		'LIBXML_HTML_NODEFDTD',
		'LIBXML_HTML_NOIMPLIED',
		'LIBXML_PEDANTIC',

		// OpenSSL:
		'OPENSSL_CIPHER_AES_128_CBC',
		'OPENSSL_CIPHER_AES_192_CBC',
		'OPENSSL_CIPHER_AES_256_CBC',
		'OPENSSL_RAW_DATA',
		'OPENSSL_ZERO_PADDING',

		// Output buffering:
		'PHP_OUTPUT_HANDLER_CLEAN',
		'PHP_OUTPUT_HANDLER_CLEANABLE',
		'PHP_OUTPUT_HANDLER_DISABLED',
		'PHP_OUTPUT_HANDLER_FINAL',
		'PHP_OUTPUT_HANDLER_FLUSH',
		'PHP_OUTPUT_HANDLER_FLUSHABLE',
		'PHP_OUTPUT_HANDLER_REMOVABLE',
		'PHP_OUTPUT_HANDLER_STARTED',
		'PHP_OUTPUT_HANDLER_STDFLAGS',
		'PHP_OUTPUT_HANDLER_WRITE',

		// Sessions:
		'PHP_SESSION_ACTIVE',
		'PHP_SESSION_DISABLED',
		'PHP_SESSION_NONE',

		// Streams:
		'STREAM_META_ACCESS',
		'STREAM_META_GROUP',
		'STREAM_META_GROUP_NAME',
		'STREAM_META_OWNER',
		'STREAM_META_OWNER_NAME',
		'STREAM_META_TOUCH',

		// Zlib:
		'ZLIB_ENCODING_DEFLATE',
		'ZLIB_ENCODING_GZIP',
		'ZLIB_ENCODING_RAW',

		// Intl:
		'U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR',
		'IDNA_CHECK_BIDI',
		'IDNA_CHECK_CONTEXTJ',
		'IDNA_NONTRANSITIONAL_TO_ASCII',
		'IDNA_NONTRANSITIONAL_TO_UNICODE',
		'INTL_IDNA_VARIANT_2003',
		'INTL_IDNA_VARIANT_UTS46',
		'IDNA_ERROR_EMPTY_LABEL',
		'IDNA_ERROR_LABEL_TOO_LONG',
		'IDNA_ERROR_DOMAIN_NAME_TOO_LONG',
		'IDNA_ERROR_LEADING_HYPHEN',
		'IDNA_ERROR_TRAILING_HYPHEN',
		'IDNA_ERROR_HYPHEN_3_4',
		'IDNA_ERROR_LEADING_COMBINING_MARK',
		'IDNA_ERROR_DISALLOWED',
		'IDNA_ERROR_PUNYCODE',
		'IDNA_ERROR_LABEL_HAS_DOT',
		'IDNA_ERROR_INVALID_ACE_LABEL',
		'IDNA_ERROR_BIDI',
		'IDNA_ERROR_CONTEXTJ',

		// Json:
		'JSON_PRETTY_PRINT',
		'JSON_UNESCAPED_SLASHES',
		'JSON_NUMERIC_CHECK',
		'JSON_UNESCAPED_UNICODE',
		'JSON_BIGINT_AS_STRING',
	);
	
	public function register()
	{
		return array(
			T_STRING,
		);
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
		if (strtolower($tokens[$stackPtr]['content']) !== 'define') {
			return;
		}
		$openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
		if ($openBracket == false) {
			return;
		}
		$firstParameterPtr = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($openBracket + 1), null, true);
		if ($firstParameterPtr == false) {
			return;
		}
		
		// define($var, 'foobar') raises warning
		if ($tokens[$firstParameterPtr]['code'] == T_VARIABLE) {
			$phpcsFile->addWarning(sprintf('constant definition with variable could be forbidden'), $firstParameterPtr);
			return;
		}
		if ($tokens[$firstParameterPtr]['code'] != T_CONSTANT_ENCAPSED_STRING) {
			return;
		}
		
		// define('string', 'foobar') check for invalid string
		$firstParameterValue = substr($tokens[$firstParameterPtr]['content'], 1, -1);
		if (in_array($firstParameterValue, $this->forbiddenConstantNames)) {
			$phpcsFile->addError(sprintf('%s is an invalid name for a constant', $firstParameterValue), $firstParameterPtr);
		}
		return;
	}
}
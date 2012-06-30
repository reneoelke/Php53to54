<?php

/**
 * Forbidden Constant Names
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
 * Forbidden Constant Names
 *
 * Search for constant definitions that define constants that have been added in
 * PHP 5.4 and would conflict with them.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_Generic_ForbiddenConstantNamesSniff
extends PHP53to54_AbstractSniff
implements PHP_CodeSniffer_Sniff
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
     * A list of forbidden constant names.
     *
     * @var array(string => array(string, [string]))
     */
    public $names = array();

    /**
     * Turn namespace checking on/off
     *
     * @var boolean
     */
    public $checkNamespace = true;

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     * @see PHP_CodeSniffer_Sniff::register()
     */
    public function register()
    {
        $this->parseArrayProperty('names');
        return array( T_STRING, T_NAMESPACE, );
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     * @see PHP_CodeSniffer_Sniff::process()
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr];

        $result = true;
        switch($token['code']) {
        case T_NAMESPACE:
            $result = $this->processNamespace($phpcsFile, $stackPtr);
            break;

        case T_STRING:
        default:
            if ($this->checkNamespace
                && $this->getLastNamespaceForFile($phpcsFile)
            ) {
                return false;
            }
            if (strtolower($token['content']) !== 'define') {
                break;
            }
            $result = $this->processConstantDefinition($phpcsFile, $stackPtr);
            break;
        }
        return $result;
    }

    /**
     * No description.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    protected function processConstantDefinition(PHP_CodeSniffer_File $phpcsFile,
        $stackPtr
    ) {
        $tokens = $phpcsFile->getTokens();

        $openBracket = $phpcsFile->findNext(
            PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true
        );
        if ($openBracket == false) {
            return false;
        }
        $firstParameterPtr = $phpcsFile->findNext(
            PHP_CodeSniffer_Tokens::$emptyTokens, ($openBracket + 1), null, true
        );
        if ($firstParameterPtr == false) {
            return false;
        }

        // define($var, 'foobar') raises warning
        if ($tokens[$firstParameterPtr]['code'] == T_VARIABLE) {
            $phpcsFile->addWarning(
                sprintf('constant definition with variable could be forbidden'),
                $firstParameterPtr,
                'possibleInvalidConstantName'
            );
            return false;
        }
        if ($tokens[$firstParameterPtr]['code'] != T_CONSTANT_ENCAPSED_STRING) {
            return false;
        }

        // define('string', 'foobar') check for invalid string
        $firstParameterValue = substr($tokens[$firstParameterPtr]['content'], 1, -1);
        if (in_array($firstParameterValue, $this->names)) {
            $phpcsFile->addError(
                sprintf(
                    '%s is an invalid name for a constant', $firstParameterValue
                ),
                $firstParameterPtr,
                'invalidConstantName'
            );
        }
        return false;
    }
}
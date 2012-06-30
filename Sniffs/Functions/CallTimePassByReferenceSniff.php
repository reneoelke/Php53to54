<?php

/**
 * CallTimePassByReferenceSniff
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
 * CallTimePassByReferenceSniff
 *
 * This searches for calls to functions with parameters passes with reference.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_Functions_CallTimePassByReferenceSniff
extends PHP53to54_AbstractSniff
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
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     * @see PHP_CodeSniffer_Sniff::register()
     */
    public function register()
    {
        return array(T_STRING);
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return void
     * @see PHP_CodeSniffer_Sniff::process()
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr];

        // check if it’s a function call
        if (!$this->isFunction($phpcsFile, $stackPtr)
            || !$this->isFunctionCall($phpcsFile, $stackPtr)
        ) {
            return;
        }
        // iterate over parameters and check if they passed with &
        $parameterTokens = $this->getFunctionCallParameters($phpcsFile, $stackPtr);
        foreach ($parameterTokens as $tmpPtr => $parameterToken) {
            $previousToken = $tokens[$tmpPtr-1];
            if ($parameterToken['code'] != T_VARIABLE) {
                continue;
            }
            if ($previousToken['code'] == T_BITWISE_AND) {
                $phpcsFile->addError(
                    'Call-time pass by reference has been removed',
                    $stackPtr,
                    'CalltimePassByReferenceRemoved'
                );
            }
        }
        return true;
    }
}
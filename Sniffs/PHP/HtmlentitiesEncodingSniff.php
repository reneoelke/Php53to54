<?php

/**
 * Changed htmlentities default Character Set
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
 * Changed htmlentities default Character Set
 *
 * Search for calls to htmlentities with no third parameter passed which will
 * use utf-8 as default encoding instead of iso in php 5.4.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_PHP_HtmlentitiesEncodingSniff
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
        return array( T_STRING, );
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

        // check function name
        if (strtolower($token['content']) !== 'htmlentities') {
            return true;
        }
        // check if it’s a function call
        if (!$this->isFunction($phpcsFile, $stackPtr)
            || !$this->isFunctionCall($phpcsFile, $stackPtr)
        ) {
            return true;
        }
        // check if third parameter defined
        $thirdParameter = $this->getFunctionCallParameterByIndex(
            $phpcsFile, $stackPtr, 2
        );
        // missing third parameter
        if (!$thirdParameter) {
            $phpcsFile->addWarning(
                'default encoding changed from ISO to UTF8',
                $stackPtr,
                'ChangedDefaultCharacterEncoding'
            );
            return true;
        }
        switch($thirdParameter['code']) {
        case T_VARIABLE:
            $phpcsFile->addWarning(
                'default encoding changed from ISO to UTF8',
                $stackPtr,
                'ChangedDefaultCharacterEncoding'
            );
            return true;

        case T_CONSTANT_ENCAPSED_STRING:
        default:
            $stringValue = substr($thirdParameter['content'], 1, -1);
            if (empty($stringValue)) {
                $phpcsFile->addWarning(
                    'default encoding changed from ISO to UTF8',
                    $stackPtr,
                    'ChangedDefaultCharacterEncoding'
                );
            }
        }
        var_dump($thirdParameter);
        return true;
    }
}
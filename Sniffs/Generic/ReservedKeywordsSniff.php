<?php

/**
 * Search for calls to array_combine
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
 * Search for reserved Keywords
 *
 * This sniff searches for the usage of the return value of array_combine
 * which changed from falso to array() if two empty arrays are passed.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_Generic_ReservedKeywordsSniff
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
     * List with reserved PHP keywords.
     *
     * @var array
     */
    private $_keywords = array(
        'callable',
        'instanceof',
        'trait',
    );

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     * @see PHP_CodeSniffer_Sniff::register()
     */
    public function register()
    {
        return array(
            T_DIR,
            T_GOTO,
            T_NAMESPACE,
            T_NS_C,
            T_STRING,
            T_USE,
        );
    }

    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     * @see PHP_CodeSniffer_Sniff::process()
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr]['content'];

        if (true === in_array($token, $this->_keywords)) {
            $error = sprintf(
                'Use of reserved keyword "%s"!',
                $token
            );
            $phpcsFile->addError($error, $stackPtr);
        }
        return true;
    }
}
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
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */

/**
 * SQLite Functions search
 *
 * Searches for calls to the SQLite Extension that has been removed from the
 * default extensions in PHP 5.4.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_Extensions_SQLiteSniff
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
     * Classnames added with SQLite extension.
     *
     * @var array
     */
    protected $classnames = array(
        'SQLiteResult',
        'SQLiteUnbuffered',
        'SQLiteDatabase',
    );

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     * @see PHP_CodeSniffer_Sniff::register()
     */
    public function register()
    {
        return array( T_EXTENDS, T_STRING, );
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

        // get previous and next token to determine type of found token
        $nextNotEmptyToken = $phpcsFile->findNext(
            PHP_CodeSniffer_Tokens::$emptyTokens,
            $stackPtr + 1, null, true
        );
        $nextToken = $tokens[$nextNotEmptyToken];

        if ($token['code'] == T_EXTENDS) {
            // extend statements, extensions of SQLiteResult or any other class
            // from the sqlite extension
            $this->processExtendStatement($phpcsFile, $stackPtr);
        } elseif ($token['code'] == T_STRING
            && $nextToken['code'] == T_DOUBLE_COLON) {
            // static object method calls
            $this->processStaticMethodCall($phpcsFile, $stackPtr);
        }
        return true;
    }

    /**
     * Process A static method call
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  the position of the current token
     *                                         in the stack
     *
     * @return boolean - always true
     */
    protected function processStaticMethodCall(PHP_CodeSniffer_File $phpcsFile,
        $stackPtr
    ) {
        $tokens = $phpcsFile->getTokens();
        $classname = $tokens[$stackPtr]['content'];
        if (in_array($classname, $this->classnames)) {
            $phpcsFile->addError(
                sprintf('%s is not supported by PHP 5.4 anymore', $classname),
                $stackPtr
            );
        }
        return true;
    }

    /**
     * Process an extend statement
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  the position of the current token
     *                                         in the stack
     *
     * @return boolean - always true
     */
    protected function processExtendStatement(PHP_CodeSniffer_File $phpcsFile,
        $stackPtr
    ) {
        $tokens = $phpcsFile->getTokens();
        $parentClassToken = $phpcsFile->findNext(T_STRING, $stackPtr + 1);
        $parentClass = $tokens[$parentClassToken]['content'];
        if (in_array($parentClass, $this->classnames)) {
            $phpcsFile->addError(
                sprintf('%s is not supported by PHP 5.4 anymore', $parentClass),
                $stackPtr
            );
        }
        return true;
    }
}
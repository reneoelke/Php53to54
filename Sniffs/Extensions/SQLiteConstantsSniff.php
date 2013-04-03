<?php

/**
 * SQLite constant sniff
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

namespace PHP53to54\Sniffs\Extensions;

use PHP_CodeSniffer_File;

use PHP_CodeSniffer_Tokens;

/**
 * Deprecated Function Call
 *
 * Searches constants from the SQLite extension that has been removed in PHP 5.4
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class SQLiteConstantsSniff implements \PHP_CodeSniffer_Sniff
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
     * List of constants added by SQLite extension in PHP 5.4.
     *
     * @var array
     */
    protected $constants = array(
        'SQLITE_ASSOC',
        'SQLITE_BOTH',
        'SQLITE_NUM',
        'SQLITE_OK',
        'SQLITE_ERROR',
        'SQLITE_INTERNAL',
        'SQLITE_PERM',
        'SQLITE_ABORT',
        'SQLITE_BUSY',
        'SQLITE_LOCKED',
        'SQLITE_NOMEM',
        'SQLITE_READONLY',
        'SQLITE_INTERRUPT',
        'SQLITE_IOERR',
        'SQLITE_NOTADB',
        'SQLITE_CORRUPT',
        'SQLITE_FORMAT',
        'SQLITE_NOTFOUND',
        'SQLITE_FULL',
        'SQLITE_CANTOPEN',
        'SQLITE_PROTOCOL',
        'SQLITE_EMPTY',
        'SQLITE_SCHEMA',
        'SQLITE_TOOBIG',
        'SQLITE_CONSTRAINT',
        'SQLITE_MISMATCH',
        'SQLITE_MISUSE',
        'SQLITE_NOLFS',
        'SQLITE_AUTH',
        'SQLITE_ROW',
        'SQLITE_DONE',
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
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The current file being checked.
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
        $constantName = $token['content'];

        // check if constant name is registered in the list of invalid names
        if (!in_array($constantName, $this->constants)) {
            return true;
        }

        // check if its a constant definition in a class
        $previousNotEmptyToken = $phpcsFile->findPrevious(
            PHP_CodeSniffer_Tokens::$emptyTokens,
            $stackPtr - 1,
            null,
            true
        );
        $previousToken = $tokens[$previousNotEmptyToken];
        if ($previousToken['code'] == T_CONST) {
            return true;
        }

        $phpcsFile->addError(
            sprintf(
                '%s from the sqlite extension is not supported by PHP 5.4 anymore',
                $token['content']
            ),
            $stackPtr
        );
        return true;
    }
}

<?php

/**
 * Search for short_open_tags ini_set
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
 * Removed INI Directives Sniff
 *
 * Search for calls to ini_set which try to set `short_open_tag` to 'on' or
 * anything which has no effect in PHP 5.4 anymore.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_PHP_INIShortOpenTagsSniff
extends PHP53to54_Sniffs_Generic_RemovedINIDirectivesSniff
{
    /**
     * A list of ini set or get functions which parameters should be checked
     *
     * @var array(string)
     */
    public $functions = array(
        'ini_set',
    );

    /**
     * A list of removed INI directives
     *
     * @var array(string)
     */
    public $names = array(
        'short_open_tag',
    );

    /**
     * Triggered when the first parameter of a ini_set call matches.
     *
     * @param PHP_CodeSniffer_File $phpcsFile     The file being scanned.
     * @param int                  $stackPtr      The position of the current token
     *                                             in the stack passed in $tokens.
     * @param string               $directiveName no description.
     *
     * @return boolean - always true
     */
    protected function foundName(PHP_CodeSniffer_File $phpcsFile, $stackPtr,
        $directiveName
    ) {
        $message = sprintf('%s changed with PHP 5.4 to always on', $directiveName);
        $phpcsFile->addWarning($message, $stackPtr);
        return true;
    }
}
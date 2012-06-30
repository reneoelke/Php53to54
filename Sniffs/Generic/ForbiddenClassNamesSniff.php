<?php

/**
 * Forbidden Classnames Sniff
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
 * Forbidden Classnames Sniff
 *
 * Search for classes that collide with the new classes introduced with php 5.4.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class PHP53to54_Sniffs_Generic_ForbiddenClassNamesSniff
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
     * A list of removed functions with their parameters associated regular
     * expression that are not allowed anymore.
     *
     * @var array(string)
     */
    public $names = array();

    /**
     * Turn namespace checking on/off
     *
     * @var boolean
     */
    public $checkNamespace = true;

    /**
     * Cache for storing last namespace names found in files while
     * parsing them.
     *
     * @var array(string = string)
     */
    protected $lastNamespacesPerFile = null;

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     * @see PHP_CodeSniffer_Sniff::register()
     */
    public function register()
    {
        $this->parseArrayProperty('names');
        return array( T_CLASS, T_NAMESPACE, );
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
        switch ($token['code']) {
        case T_NAMESPACE:
            $result = $this->processNamespace($phpcsFile, $stackPtr);
            break;

        case T_CLASS:
        default:
            // only check classnames if we're in global namespace
            if ($this->checkNamespace && !empty($this->lastNamespace)) {
                break;
            }
            $result = $this->processClass($phpcsFile, $stackPtr);
            break;
        }
        return $result;
    }

    /**
     * No description.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return boolean - always true
     */
    protected function processClass(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $next = $phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false);
        $classnameToken = $tokens[$next];
        $classname = $classnameToken['content'];

        $forbiddenClassnames = array_map('strtolower', $this->names);
        if (in_array(strtolower($classname), $forbiddenClassnames)) {
            $phpcsFile->addError(
                sprintf(
                    '%s classname is a reserved classname in PHP 5.4', $classname
                ),
                $stackPtr, 'forbiddenClassname'
            );
        }

        return true;
    }
}
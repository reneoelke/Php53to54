<?php
/**
 * Removed INI Directives Sniff
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

namespace PHP53to54\Sniffs\PHP;

use PHP53to54\Sniffs\Generic\RemovedINIDirectivesSniff;

use PHP_CodeSniffer_File;

/**
 * Removed INI Directives Sniff
 *
 * Search for calls to php_ini_set which try to change some of the removed
 * php ini directives.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class SaveModeINIDirectivesSniff extends RemovedINIDirectivesSniff
{
    /**
     * A list of ini set or get functions which parameters should be checked
     *
     * @var array(string)
     */
    public $functions = array(
        'ini_get',
    );

    /**
     * A list of removed INI directives
     *
     * @var array(string)
     */
    public $names = array(
        'safe_mode',
        'safe_mode_gid',
        'safe_mode_include_dir',
        'safe_mode_exec_dir',
        'safe_mode_allowed_env_vars',
        'safe_mode_protected_env_vars',
    );

    /**
     * Triggered when the first parameter of a ini_set call matches
     *
     * @param PHP_CodeSniffer_File $phpcsFile     The file being scanned.
     * @param int                  $stackPtr      The position of the current token
     *                                             in the stack passed in $tokens.
     * @param string               $directiveName no description.
     *
     * @return boolean - always true
     */
    protected function foundName(
        PHP_CodeSniffer_File $phpcsFile,
        $stackPtr,
        $directiveName
    ) {
        $message = sprintf(
            '%s is part of safe_mode which was removed in PHP 5.4',
            $directiveName
        );
        $phpcsFile->addWarning($message, $stackPtr, 'INIDirectiveDeprecated');
        return true;
    }
}

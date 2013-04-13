<?php
/**
 * putenv TZ Sniff
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/Php53to54
 * @since     1.0-beta
 */

namespace Php53to54\Sniffs\PHP;

use PHP_CodeSniffer_File;

/**
 * putenv TZ sniff
 *
 * The TZ environment variable is not longer checked by the date/time extension
 * and thus this searches for calls to putenv that try to set TZ.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/Php53to54
 * @since     1.0-beta
 */
class PutenvTZSniff extends RemovedFunctionParametersSniff
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

        if (strtolower($token['content']) !== 'putenv') {
            return true;
        }
        // find first string param
        $next = $phpcsFile->findNext(
            array(T_DOUBLE_COLON),
            $stackPtr + 2,
            null,
            true
        );
        if (!($firstParameterPtr = $next)) {
            return true;
        }
        $firstParameter = substr($tokens[$firstParameterPtr]['content'], 1, -1);
        if (preg_match('/^TZ=/', $firstParameter)) {
            $phpcsFile->addError(
                'TZ environment variable not longer checked',
                $stackPtr,
                'TZ'
            );
        }
        return true;
    }
}

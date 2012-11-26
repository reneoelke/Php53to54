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

namespace PHP53to54\Sniffs\PHP;

use PHP53to54\AbstractSniff;

use PHP_CodeSniffer_File;

/**
 * Search for calls to array_combine
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
class ArrayCombineSniff extends AbstractSniff
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

        $functionName = strtolower($token['content']);
        if ($functionName !== 'array_combine') {
            return true;
        }
        if (!$this->isFunction($phpcsFile, $stackPtr)
            || !$this->isFunctionCall($phpcsFile, $stackPtr)
        ) {
            return true;
        }
        // trying to find out if array_combine is used as a return value
        $message = sprintf('array_combine return value changed');
        $phpcsFile->addError($message, $stackPtr, 'ArrayCombineReturnValueChanged');
        return true;
    }
}

<?php
/**
 * E_ALL & E_STRICT check
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
 * E_ALL & E_STRICT check
 *
 * Searches for calls to error_reporting where E_ALL and E_STRICT is set which
 * is not needed anymore.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class EStrictSniff extends AbstractSniff
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
        if (strtolower($token['content']) !== 'error_reporting') {
            return true;
        }
        // check if it’s a function call
        if (!$this->isFunction($phpcsFile, $stackPtr)
            || !$this->isFunctionCall($phpcsFile, $stackPtr)
        ) {
            return;
        }
        $openParenthesisPtr = $stackPtr + 1;
        $closingParenthesisPtr = $tokens[$openParenthesisPtr]['parenthesis_closer'];
        $closingParenthesisToken = $tokens[$closingParenthesisPtr];

        $parameters = $phpcsFile->getTokensAsString(
            $openParenthesisPtr + 1,
            $closingParenthesisPtr - $openParenthesisPtr - 1
        );
        if (preg_match('/E_ALL\s*\|\s*E_STRICT/', $parameters)) {
            $phpcsFile->addError(
                'E_ALL allready includes E_STRICT',
                $stackPtr,
                'ErrorReportingAllreadyIncluded'
            );
        }
        return true;
    }
}

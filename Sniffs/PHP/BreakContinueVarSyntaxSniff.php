<?php
/**
 * Continue/Break syntax without variable
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

use PHP_CodeSniffer_Tokens;

/**
 * Continue/Break syntax without variable
 *
 * Searches for break or continue statements that use parameters which is not
 * allowed anymore in PHP 5.4.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/Php53to54
 * @since     1.0-beta
 */
class BreakContinueVarSyntaxSniff implements \PHP_CodeSniffer_Sniff
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
     * Prepared key test.
     *
     * @var array
     */
    protected $testTokenKeys = array(
        T_WHITESPACE => true,
        T_LNUMBER => true,
        T_SEMICOLON => true,
    );

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     * @see PHP_CodeSniffer_Sniff::register()
     */
    public function register()
    {
        return array( T_BREAK, T_CONTINUE, );
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
        // iterate over next tokens and search for hints to variable usage
        // or method/function calls
        $nextSemicolonToken = $phpcsFile->findNext(
            T_SEMICOLON,
            $stackPtr,
            null,
            false
        );
        if (!$nextSemicolonToken) {
            return false;
        }

        $curToken = $stackPtr + 1;
        while ($curToken++ < $nextSemicolonToken) {
            $nextNotEmptyToken = $phpcsFile->findNext(
                PHP_CodeSniffer_Tokens::$emptyTokens,
                $curToken,
                null,
                true
            );
            $nextToken = &$tokens[$nextNotEmptyToken];

            if (!isset($this->testTokenKeys[$nextToken['code']])) {
                $phpcsFile->addError(
                    'break/continue allows only integers nothing else.',
                    $stackPtr
                );
                break ;
            }

            if ($nextToken['content'] == '0') {
                $phpcsFile->addError(
                    'break/continue 0 is no longer allowed. Use without argument.',
                    $stackPtr
                );
                break ;
            }
        }
        return true;
    }
}

<?php
/**
 * Removed Function Parameters
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
 * Removed Function Parameters
 *
 * Search for function calls of functions that have invalid parameters.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
class RemovedFunctionParametersSniff extends AbstractSniff
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
     * @var array(string => array(string, [string]))
     */
    protected $forbiddenFunctionsParameters = array(
        'hash_file' => array('/salsa[1-2]0/'),
        'hash_hmac_file' => array('/salsa[1-2]0/'),
        'hash_hmac' => array('/salsa[1-2]0/'),
        'hash_init' =>array('/salsa[1-2]0/'),
        'hash' => array('/salsa[1-2]0/'),
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

        if (!$this->isFunction($phpcsFile, $stackPtr)
            || !$this->isFunctionCall($phpcsFile, $stackPtr)
        ) {
            return ;
        }
        $functionName = strtolower($tokens[$stackPtr]['content']);
        if (!isset($this->forbiddenFunctionsParameters[$functionName])) {
            return ;
        }

        $parameterTokens = $this->getFunctionCallParameters($phpcsFile, $stackPtr);
        $parameterRegExps = $this->forbiddenFunctionsParameters[$functionName];
        foreach ($parameterTokens as $index => $parameterToken) {
            // only look at first function parameters
            if ($index > 1) {
                continue;
            }
            $tokenContent = $parameterToken['content'];
            switch($parameterToken['code']) {
                case T_CONSTANT_ENCAPSED_STRING:
                    if (!isset($parameterRegExps[$index])) {
                        continue;
                    }
                    $regexp = $parameterRegExps[$index];
                    $string = substr($tokenContent, 1, -1);
                    if (preg_match($regexp, $string)) {
                        $phpcsFile->addError(
                            sprintf(
                                '%s function parameter %d value %s is invalid',
                                $functionName,
                                $index,
                                $functionName
                            ),
                            $stackPtr
                        );
                    }
                    break;
                case T_VARIABLE:
                default:
                    $phpcsFile->addWarning(
                        sprintf(
                            '%s function parameter %s is possibly deprecated',
                            $functionName,
                            $tokenContent
                        ),
                        $stackPtr
                    );
                    break;
            }
        }
    }
}

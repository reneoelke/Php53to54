<?php
/**
 * Forbidden Function Parameter
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

use Php53to54\AbstractSniff;

use PHP_CodeSniffer_File;

/**
 * Forbidden Function Parameter
 *
 * Search for function or closure definitions that use global variable as their
 * parameters.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/Php53to54
 * @since     1.0-beta
 */
class ForbiddenParameterSniff extends AbstractSniff
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
    protected $forbiddenParameterNames = array(
        '$GLOBALS' => true,
        '$_SERVER' => true,
        '$_GET' => true,
        '$_POST' => true,
        '$_SET' => true,
        '$_FILES' => true,
        '$_COOKIE' => true,
        '$_SESSION' => true,
        '$_REQUEST' => true,
        '$_ENV' => true,
    );

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     * @see PHP_CodeSniffer_Sniff::register()
     */
    public function register()
    {
        return array( T_FUNCTION, T_CLOSURE, );
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return void
     * @see PHP_CodeSniffer_Sniff::process()
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $functionNamePtr = $phpcsFile->findNext(
            array( T_STRING, ),
            ($stackPtr + 1),
            null,
            false
        );

        $parameterTokens = $this->getFunctionDefinitionParameters(
            $phpcsFile,
            $functionNamePtr
        );
        if (!$parameterTokens) {
            return false;
        }
        foreach ($parameterTokens as $index => $parameterToken) {
            $variableName = $parameterToken['content'];
            if (!isset($this->forbiddenParameterNames[$variableName])) {
                continue;
            }
            $phpcsFile->addWarning(
                sprintf('%s is not a valid function parameter', $variableName),
                $stackPtr
            );
        }
    }
}

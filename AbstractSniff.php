<?php
/**
 * AbstractSniff
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

namespace PHP53to54;

use PHP_CodeSniffer_File;

use PHP_CodeSniffer_Tokens;

use LogicException;

/**
 * AbstractSniff
 *
 * PHP53to54 base class for Sniffs that provides methods that can be used in
 * various Sniffs.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @author    Maik Penz // <maik@phpkuh.de>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license   BSD http://www.opensource.org/licenses/bsd-license.php
 * @link      https://github.com/foobugs/PHP53to54
 * @since     1.0-beta
 */
abstract class AbstractSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Cache for storing last namespace names found in files while
     * parsing them.
     *
     * @var array(string = string)
     */
    protected $lastNamespacesPerFile = null;

    /**
     *
     * @var array
     */
    protected $functionCallParametersMap = array(
        T_CONSTANT_ENCAPSED_STRING,
        T_VARIABLE,
        T_NULL,
        T_LNUMBER,
        T_DNUMBER
    );

    /**
     * Parse array property.
     *
     * @param string $propertyName property name
     *
     * @return \PHP53to54\AbstractSniff - fluent interface
     */
    protected function parseArrayProperty($propertyName)
    {
        if (!is_string($this->{$propertyName})) {
            return true;
        }
        $this->{$propertyName} = preg_split('/[\s,\r\n]/', $this->{$propertyName});
        $this->{$propertyName} = array_map('trim', $this->{$propertyName});
        $this->{$propertyName} = array_filter($this->{$propertyName});
        return $this;
    }

    /**
     * Get last namespace.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     *
     * @return string
     */
    protected function getLastNamespaceForFile(PHP_CodeSniffer_File $phpcsFile)
    {
        $filename = $phpcsFile->getFilename();
        if (!isset($this->lastNamespacesPerFile[$filename])) {
            return false;
        }
        return $this->lastNamespacesPerFile[$filename];
    }

    /**
     * Process namespace.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return boolean - always true
     */
    protected function processNamespace(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr];
        $namspaceToken = $tokens[
            $phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false)
        ];
        $this->lastNamespacesPerFile[$phpcsFile->getFilename()]
            = strtolower($namspaceToken['content']);
        return true;
    }

    /**
     * Get function definition parameters.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return array - false on error
     */
    public function getFunctionDefinitionParameters(
        PHP_CodeSniffer_File $phpcsFile,
        $stackPtr
    ) {
        $tokens = $phpcsFile->getTokens();
        $openBracket = $phpcsFile->findNext(
            PHP_CodeSniffer_Tokens::$emptyTokens,
            ($stackPtr + 1),
            null,
            true
        );
        if (!isset($tokens[$openBracket]['parenthesis_closer'])) {
            return false;
        }
        $closeBracket = $tokens[$openBracket]['parenthesis_closer'];

        $parameters = array();
        $tmpPtr = $openBracket;
        $parameterIndex = 1;
        while (
            ($tmpPtr = $phpcsFile->findNext(array(T_VARIABLE), $tmpPtr))
            !== false
        ) {
            if ($tmpPtr > $closeBracket) {
                break;
            }
            $parameters[$parameterIndex] = $tokens[$tmpPtr];
            $tmpPtr++;
            $parameterIndex++;
        }
        return $parameters;
    }

    /**
     * Is function.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return boolean
     */
    public function isFunction(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $openBracket = $phpcsFile->findNext(
            PHP_CodeSniffer_Tokens::$emptyTokens,
            ($stackPtr + 1),
            null,
            true
        );
        if ($tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
            return false;
        }
        if (isset($tokens[$openBracket]['parenthesis_closer']) === false) {
            return false;
        }
        return true;
    }

    /**
     * Is function call.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return boolean
     */
    public function isFunctionCall(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $search = PHP_CodeSniffer_Tokens::$emptyTokens;
        $search[] = T_BITWISE_AND;
        $previous = $phpcsFile->findPrevious($search, ($stackPtr - 1), null, true);
        if ($tokens[$previous]['code'] === T_FUNCTION) {
            return false;
        }
        return true;
    }

    /**
     * Get function call parameters.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return array - false on error
     */
    public function getFunctionCallParameters(
        PHP_CodeSniffer_File $phpcsFile,
        $stackPtr
    ) {
        $tokens = $phpcsFile->getTokens();
        $openBracket = $phpcsFile->findNext(
            PHP_CodeSniffer_Tokens::$emptyTokens,
            ($stackPtr + 1),
            null,
            true
        );
        if (!isset($tokens[$openBracket]['parenthesis_closer'])) {
            return false;
        }
        $closeBracket = $tokens[$openBracket]['parenthesis_closer'];

        $parameters = array();
        $tmpPtr = $openBracket;
        while ((bool) $tmpPtr = $phpcsFile->findNext($this->functionCallParametersMap, $tmpPtr)) {
            if ($tmpPtr > $closeBracket) {
                break;
            }
            $parameters[$tmpPtr] = $tokens[$tmpPtr];
            $tmpPtr++;
        }
        return $parameters;
    }

    /**
     * Get function call parameter by index.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     * @param int                  $index     index
     *
     * @return mixed - false on error
     */
    public function getFunctionCallParameterByIndex(
        PHP_CodeSniffer_File $phpcsFile,
        $stackPtr,
        $index
    ) {
        $i = 0;
        $parameters = $this->getFunctionCallParameters($phpcsFile, $stackPtr);
        foreach ($parameters as $parameter) {
            if ($i == $index) {
                return $parameter;
            }
            $i++;
        }
        return false;
    }
}

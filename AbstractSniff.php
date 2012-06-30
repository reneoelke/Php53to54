<?php

/**
 * AbstractSniff
 *
 * PHP version 5
 *
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */

/**
 * AbstractSniff
 *
 * Jaggers base class for Sniffs that provides methods that can be used in
 * various Sniffs.
 *
 * @category PHP
 * @package PHP_CodeSniffer
 * @author Marcel Eichner // foobugs <marcel.eichner@foobugs.com>
 * @author Maik Penz // <maik@phpkuh.de>
 * @copyright 2012 foobugs oelke & eichner GbR
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 * @link https://github.com/foobugs/PHP53to54
 * @since 1.0-beta
 */
abstract class PHP53to54_AbstractSniff
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
    protected $_functionCallParametersMap = array(T_CONSTANT_ENCAPSED_STRING, T_VARIABLE, T_NULL, T_LNUMBER, T_DNUMBER);

    /**
     *
     * @param string $propertyName
     * @return PHP53to54_AbstractSniff - fluent interface
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
     *
     * @param PHP_CodeSniffer_File $phpcsFile
     * @return string
     */
    protected function getLastNamespaceForFile(PHP_CodeSniffer_File $phpcsFile)
    {
        $filename = $phpcsFile->getFilename();
        if (empty($this->lastNamespacesPerFile[$filename])) {
            return false;
        }
        return $this->lastNamespacesPerFile[$filename];
    }

    /**
     *
     * @param PHP_CodeSniffer_File $phpcsFile
     * @param integer $stackPtr
     * @return boolean - always true
     */
    protected function processNamespace(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr];
        $namspaceToken = $tokens[$phpcsFile->findNext(array(T_STRING), ($stackPtr + 1), null, false)];
        $this->lastNamespacesPerFile[$phpcsFile->getFilename()] = strtolower($namspaceToken['content']);
        return true;
    }

    /**
     *
     * @param PHP_CodeSniffer_File $phpcsFile
     * @param integer $stackPtr
     * @return array - false on error
     */
    public function getFunctionDefinitionParameters(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if (!isset($tokens[$openBracket]['parenthesis_closer'])) {
            return false;
        }
        $closeBracket = $tokens[$openBracket]['parenthesis_closer'];

        $parameters = array();
        $tmpPtr = $openBracket;
        while (($tmpPtr = $phpcsFile->findNext(array(T_VARIABLE), $tmpPtr)) !== false) {
            if ($tmpPtr > $closeBracket) break;
            $parameters[] = $tokens[$tmpPtr];
            $tmpPtr++;
        }
        return $parameters;
    }

    /**
     *
     * @param PHP_CodeSniffer_File $phpcsFile
     * @param integer $stackPtr
     * @return boolean
     */
    public function isFunction(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
            return false;
        }
        if (isset($tokens[$openBracket]['parenthesis_closer']) === false) {
            return false;
        }
        return true;
    }

    /**
     *
     * @param PHP_CodeSniffer_File $phpcsFile
     * @param integer $stackPtr
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
     *
     * @param PHP_CodeSniffer_File $phpcsFile
     * @param integer $stackPtr
     * @return array - false on error
     */
    public function getFunctionCallParameters(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $openBracket = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if (!isset($tokens[$openBracket]['parenthesis_closer'])) {
            return false;
        }
        $closeBracket = $tokens[$openBracket]['parenthesis_closer'];

        $parameters = array();
        $tmpPtr = $openBracket;
        while (($tmpPtr = $phpcsFile->findNext($this->_functionCallParametersMap, $tmpPtr)) !== false) {
            if ($tmpPtr > $closeBracket) {
                break;
            }
            $parameters[$tmpPtr] = $tokens[$tmpPtr];
            $tmpPtr++;
        }
        return $parameters;
    }

    /**
     *
     * @param PHP_CodeSniffer_File $phpcsFile
     * @param integer $stackPtr
     * @param integer $index
     * @return mixed - false on error
     */
    public function getFunctionCallParameterByIndex(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $index)
    {
        $i = 0;
        foreach($this->getFunctionCallParameters($phpcsFile, $stackPtr) as $parameter) {
            if ($i == $index) {
                return $parameter;
            }
            $i++;
        }
        return false;
    }
}
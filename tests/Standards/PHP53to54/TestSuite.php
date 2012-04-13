<?php

require_once 'PHPUnit/Framework/TestSuite.php';

class PHP53to54_TestSuite extends PHPUnit_Framework_TestSuite
{
	public static function main()
	{
		PHPUnit_TextUI_TestRunner::run(self::suite());
	}
	
	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite('PHP53to54 Standard');
		
		require_once __DIR__.'/../AbstractSniffUnitTest.php';
		
		require_once __DIR__.'/Deprecated/FunctionAliasesSniffUnitTest.php';
		$suite->addTestSuite('PHP53to54_Tests_Deprecated_FunctionAliasesSniffUnitTest');
		require_once __DIR__.'/Deprecated/FunctionsSniffUnitTest.php';
		$suite->addTestSuite('PHP53to54_Tests_Deprecated_FunctionsSniffUnitTest');
		
		require_once __DIR__.'/PHP/RemovedFunctionParametersSniffUnitTest.php';
		$suite->addTestSuite('PHP53to54_Tests_PHP_RemovedFunctionParametersUnitTest');
		
		return $suite;
	}
}
<?php

require_once 'PHPUnit/TextUI/TestRunner.php';
require_once 'PHP/CodeSniffer.php';

/**
 * Usage: phpunit AllTests.php
 */
class Jagger_AllTests
{
	/**
	 * Launches the TextUI test runner
	 *
	 * @return void
	 * @uses PHPUnit_TextUI_TestRunner
	 */
	public static function main()
	{
		PHPUnit_TextUI_TestRunner::run(self::suite());
	}
	
	/**
	 * Adds all class test suites into the master suite
	 *
	 * @return PHPUnit_Framework_TestSuite a master test suite
	 *                                     containing all class test suites
	 * @uses PHPUnit_Framework_TestSuite
	 */ 
	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite('Jagger');
		
		require_once __DIR__.'/Standards/PHP53to54/TestSuite.php';
		$suite->addTestSuite(PHP53to54_TestSuite::suite());
		
		return $suite;
	}
}
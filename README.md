# Jagger

A set of sniffs for [PHP_CodeSniffer](http://pear.php.net/PHP_CodeSniffer) that can check if a project is compatible with PHP 5.4.

This project is currently in progress and not usable!

# Installation

* Install [PHP_CodeSniffer](http://pear.php.net/PHP_CodeSniffer) with

	pear install PHP_CodeSniffer
	
* Checkout this repository to the sniff repository of PHP_CodeSniffer that is located in the PEAR package. Usually something like this:

	git clone [repository-url] [CodeSniffer Standards Directory]
	
	mac: /usr/lib/php/pear/PHP/CodeSniffer/Standards
	ubuntu: /usr/share/php/PHP/CodeSniffer/Standard

# Usage

After you’ve installed the jagger-sniffs to your PHP_CodeSniffer directory you can specify the coding standard, i.e. the sniffs you want to use with PHP_CodeSniffer. The following command uses all sniffs defined in jagger to check all files and directories:

	phpcs --standard="jagger" .
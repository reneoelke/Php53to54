# Jagger

A set of sniffs for [PHP_CodeSniffer](http://pear.php.net/PHP_CodeSniffer) that can check if a project is compatible with PHP 5.4.

THIS PROJECT IS IN DEVELOPMENT (PRE-ALPHA) AND SHOULD NOT BE USED UNLESS YOU KNOW WHAT YOU’RE DOING!

# Features

* Checks for deprecated and removed function calls also including removed extensions (SQLite)
* Checks for definition classes, interfaces, constants that would collide with new ones added in PHP 5.4 (namespace-aware)
* Check for variable usage in `break`/`continue` statements
* Check for added or removed function parameters
* Check for call time pass by reference which is not allowed anymore

# Installation

* Install [PHP_CodeSniffer](http://pear.php.net/PHP_CodeSniffer) with

	pear install PHP_CodeSniffer
	
* Checkout this repository to the sniff repository of PHP_CodeSniffer that is located in the PEAR package. Usually something like this:

	git clone [repository-url] [CodeSniffer Standards Directory]
	
	mac: /usr/lib/php/pear/PHP/CodeSniffer/Standards
	ubuntu: /usr/share/php/PHP/CodeSniffer/Standard

# Usage

After you’ve installed the jagger-sniffs to your PHP_CodeSniffer directory you can specify the coding standard, i.e. the sniffs you want to use with PHP_CodeSniffer. The following command uses all sniffs defined in jagger to check all files and directories:

	phpcs -p --standard="PHP53to54" .
	
Excluding Files

	phpcs --standard="PHP53to54" --ignore=*.js,*.ctp

Define file extensions that should be checked

	phpcs --standard="PHP53to54" --extensions=php,js
	
Increase memory limit for phpcs 

	phpcs --sstandard="PHP53to54" -d memory_limit=32M
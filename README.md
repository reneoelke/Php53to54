# PHP53to54

PHP53to54 is a collection of sniffs for [PHP_CodeSniffer](http://pear.php.net/PHP_CodeSniffer) that check an PHP 5.3 application for PHP 5.4 compatibility.

## Features

* Check for removed, deprecated or changed function, methods, constants etc. including stuff from removed or changed extensions
* Scan for usage of added, changed or removed parameters
* Search for removed ini-directives
* Namespace-aware scan for class, interface, constant definitions that would collide with new ones
* Check for invalid `break`/`continue` statements
* Check for call time pass by reference

## Installation

Make sure you have [PHP_CodeSniffer 1.3+](http://pear.php.net/PHP_CodeSniffer) allready installed and the latest version.

	pear install PHP_CodeSniffer
	
### Git-Install

Run the following code in your `pear/PHP/CodeSniffer/Standards` directory:

	git clone git://github.com/foobugs/PHP53to54.git
	
### ZIP Install

Download the [ZIP](https://github.com/foobugs/PHP53to54/zipball/master) file and extract everything into `pear/PHP/CodeSniffer/Standards`

## Usage

After you have installed PHP53to54 successfully (you can check it by running `phpcs -i` and see if PHP53to54 ist listed) you can specifiy the Standard when calling PHP_CodeSniffer:

	phpcs -p --standard=PHP53to54 <source-path>
	
If you did not put the Standard into PHP_CodeSniffers Standard directory you can specify the external location of the standard like this:

	phpcs -p -standard=/Users/frank/Downloads/PHP53to54/Standards/PHP53to54 <source-path>

You can find more options and arguments (f.i. ignoring files, extensions, memory limit) in the official [PHP_CodeSniffer Manual](http://pear.php.net/manual/en/package.php.php-codesniffer.php).
	
## Future

We plan to include more sniffs as PHP 5.5 oder later will be released.

## Participate!

You can participate in this project by forking the [Repository](https://github.com/foobugs/PHP53to54) and push changes back to the project. Feel free to post issues or whishes in the [issue section](https://github.com/foobugs/PHP53to54/issues).
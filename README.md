Php53to54
===============================================================================

Php53to54 is a collection of sniffs for [PHP_CodeSniffer](http://pear.php.net/PHP_CodeSniffer) that check an PHP 5.3 application for PHP 5.4 compatibility.

**This project is currently under development**
 
 Features
--------

* Check for removed, deprecated or changed function, methods, constants etc. including stuff from removed or changed extensions
* Scan for usage of added, changed or removed parameters
* Search for removed ini-directives
* Namespace-aware scan for class, interface, constant definitions that would collide with new ones
* Check for invalid `break`/`continue` statements
* Check for call time pass by reference

[Detailed feature list](FEATURES.md).

Requirements
------------

* [composer](http://getcomposer.org/doc/00-intro.md#installation-nix)

Installation
------------

For the next two options make sure you’ve PHP_CodeSniffer installed. After that you can either put this standard into the PHP_CodeSniffer Standards directory located in your PEAR directory: (`pear/PHP/CodeSniffer/Standards`) or place the standard somewhere else and use it as standalone standard.

### Composer (recommended)

You can add the standard to your vendors directory by adding the dependency to your projects `composer.json`:

    "require-dev": {
        "foobugs-standards/php53to54": "*",
    }

Usage
-----

### Composer install

After an update with `composer install --dev`, you are able to include the standard like:

    vendor/bin/phpcs --standard=php53to54 <source-path>

### External standard
    
If you did not put the Standard into PHP_CodeSniffers Standard directory you can specify the external location of the standard. Note that the path to the standard must be a full qualified path:

    phpcs --standard=/Users/frank/Downloads/Php53to54 <source-path>

You can find more options and arguments (f.i. ignoring files, extensions, memory limit) in the official [PHP_CodeSniffer Manual](http://pear.php.net/manual/en/package.php.php-codesniffer.php).

Development
-----------

Install with

    composer install --dev

Before you send a pull request make sure to add a test for your changes.

Both testsuite and coding standard tests must pass before a pull request can be accepted:

    vendor/bin/phpunit
    vendor/bin/phpcs --standard=psr2 Sniffs/ AbstractSniff.php

The testsuite utilises integration tests for a single or few sniffs and a single file at a time.
If such a test fails you will get a `Mismatch between expected and reported %` message and a dump.

Dumped is a multidimensional array with rows formated like
```php
   ROW . ':' . COLUMN => array(ERROR_CODE, SERVERITY),
   // example
   # '8:1' => array('Php53to54.Generic.ForbiddenInterfaceNames.invalidInterfaceName', 5)
```

Usually only missing or exceeding offsets should be reported.

Participate!
------------

You can participate in this project by forking the [Repository](https://github.com/foobugs-standards/Php53to54/) and push changes back to the project. Feel free to post issues or whishes in the [issue section](https://github.com/foobugs-standards/Php53to54/issues).

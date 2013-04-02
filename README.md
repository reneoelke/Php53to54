PHP migrations template for phpcs
=================================

Abstract [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) standard with
[composer](http://getcomposer.org) integration and development tools (phpunit).

Feel free to use this repositor as starting point for your own CodeSniffer standards, write really simple integration tests for them and install everywhere with composer.

usage
-----

Get a _fresh_ git repository with `git init` or `git clone`.

Merge like:
 
```/bin/bash
git remote add upstream git://github.com/php-migrations/abstract-standard.git
git pull upstream master
```

Add your ruleset, sniffs and tests.

Name it within the composer.json (and add to [packagist](http://packagist.org)).

provides
--------

* dependencies: PHP_CodeSniffer, phpcs_installer, phpunit (dev-only)
* phpcs integration when using composer: `vendor/bin/phpcs --standard=MY_STANDARD`
* travis integration: just activate the hook
* phpunit integration

requires
--------

* PHP 5.3.2 or newer
* [composer](http://getcomposer.org/doc/00-intro.md#installation-nix)

Unit tests only run on *nix systems (bash-like shell).

`!!! TODO link travis !!!`

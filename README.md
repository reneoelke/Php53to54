PHP migrations template for phpcs
=================================

Abstract [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) standard shipped with
[composer](http://getcomposer.org) integration and development tools.

DEV-ONLY.

usage
-----

[Fork](https://help.github.com/articles/fork-a-repo) or *remote pull* the repository.

Add your ruleset, sniffs and tests.

Fix the README.md and LICENCE.

Give it a name in your composer.json (and add to [packagist](http://packagist.org)).

Composed and ready to sniff.

provides
--------

* dependencies: PHP_CodeSniffer, installer
* phpcs integration when composing: enables `vendor/bin/phpcs --standard=MY_STANDARD`
* travis integration: just activate the hook
* phpunit integration – on demand
* vagrant integration: sniff anywhere with your own virtual box – on demand

requires
--------

* PHP 5.3.2+ (or vagrant)
* composer (might need curl)
* git

`!!! TODO link composer install guide !!!`
`!!! TODO link vagrant !!!`
`!!! TODO link travis !!!`

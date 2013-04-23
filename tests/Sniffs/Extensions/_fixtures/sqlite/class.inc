<?php

// invalid stuff
class foo extends SQLiteDatabase {}
class foo extends \SQLiteDatabase {}
abstract class foo extends SQLiteDatabase {
    static function bar($arg, SQLiteDatabase $arg2) {}
}
function foo(SQLiteDatabase $bar) {}
function foo(\SQLiteDatabase $bar) {}
use SQLiteDatabase as X;


// checklist
$x = new SQLiteResult();
$x = new SQLiteUnbuffered();
$x = new SQLiteDatabase();

// valid stuff

function callbackfilteriterator() {}
function CallbackFilterIterator() {}

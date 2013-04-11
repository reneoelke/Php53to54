<?php

// valid
echo "snmp_set_oid_numeric_print()";

// fail
snmp_set_oid_numeric_print();

echo "any string".snmp_set_oid_numeric_print();

foreach(snmp_set_oid_numeric_print() as $something) {

}

class MyClass
{
    function snmp_set_oid_numeric_print()
    {
        return snmp_set_oid_numeric_print();
    }
}

// false positives
trait snmp_set_oid_numeric_print {}

interface snmp_set_oid_numeric_print {}

abstract class snmp_set_oid_numeric_print {}

<?php

// valid
echo "snmp_set_oid_numeric_print()";

trait snmp_set_oid_numeric_print {}

interface snmp_set_oid_numeric_print {}

abstract class snmp_set_oid_numeric_print {
    function snmp_set_oid_numeric_print() {}
}

function snmp_set_oid_numeric_print () {}

SomeClass::snmp_set_oid_numeric_print();

$someObj->snmp_set_oid_numeric_print();

// fail
snmp_set_oid_numeric_print();

echo "any string".snmp_set_oid_numeric_print();

foreach(snmp_set_oid_numeric_print() as $something) {

}

class MyClass {
    function foo() {
        return snmp_set_oid_numeric_print();
    }
}

// checklist
snmp_get_quick_print();
snmp_get_valueretrieval();
snmp_read_mib();
snmp_set_enum_print();
snmp_set_oid_numeric_print();
snmp_set_oid_output_format();
snmp_set_quick_print();
snmp_set_valueretrieval();
snmp2_get();
snmp2_getnext();
snmp2_real_walk();
snmp2_set();
snmp2_walk();
snmp3_get();
snmp3_getnext();
snmp3_real_walk();
snmp3_set();
snmp3_walk();
snmpget();
snmpgetnext();
snmprealwalk();
snmpset();
snmpwalk();
snmpwalkoid();

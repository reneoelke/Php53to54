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
	function myMethod()
	{
		return snmp_set_oid_numeric_print();
	}
}
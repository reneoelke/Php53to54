<?php

return array(
        array(
        // fixture
        'test.php',
        // standard
        'php53to54',
        // sniffs
        array('PHP53to54.SNMP.DeprecatedFunctions'),
        // errors
        array(
        ),
        // warnings
        array(
            '7:1' => "PHP53to54.SNMP.DeprecatedFunctions.Deprecated",
            '9:19' => "PHP53to54.SNMP.DeprecatedFunctions.Deprecated",
            '11:9' => "PHP53to54.SNMP.DeprecatedFunctions.Deprecated",
            '19:16' => "PHP53to54.SNMP.DeprecatedFunctions.Deprecated",
        ),
    ),
);

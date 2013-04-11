<?php

return array(
    array(
        // fixture
        '1.inc',
        // standard
        'php53to54',
        // sniffs
        array('PHP53to54.Functions.CallTimePassByReference'),
        // errors
        array(
            '41:13' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
            '42:4' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
            '43:13' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
            '44:16' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
            '45:10' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
            '47:18' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
            '50:15' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
            '52:5' =>"PHP53to54.Functions.CallTimePassByReference.NotAllowed",
        ),
        // warnings
        array(
        ),
    ),
);

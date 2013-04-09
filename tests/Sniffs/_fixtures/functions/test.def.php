<?php

return array(
    array(
        // fixture
        'callTimePassByReference.php',
        // standard
        'php53to54',
        // sniffs
        array('PHP53to54.Functions.CallTimePassByReference'),
        // errors
        array(
            '41:14' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '42:5' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '43:14' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '44:18' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '45:19' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '46:11' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '46:20' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '47:11' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            '49:20' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
            // last one is a false-positive
            // '51:32' =>"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",
        ),
        // warnings
        array(
        ),
    ),
);

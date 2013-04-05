<?php

return array(
    // fixture
    'test.php',
    // standard
    'php53to54',
    // sniffs
    array('PHP53to54.Functions.CallTimePassByReference'),
    // errors
    array(
        array(41,14,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(42,5,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(43,14,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(44,18,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(45,19,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(46,11,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(46,20,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(47,11,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        array(49,20,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
        // last one is a false-positive
        // array(51,32,"PHP53to54.Functions.CallTimePassByReference.CalltimePassByReferenceRemoved",5),
    ),
    // warnings
    array(
    ),
);

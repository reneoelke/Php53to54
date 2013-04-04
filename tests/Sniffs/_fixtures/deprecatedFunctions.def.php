<?php

return array(
    // fixture
    'deprecated.php',
    // standard
    'php53to54',
    // sniffs
    array('PHP53to54.Deprecated.Functions'),
    // errors
    array(
        array(8,1,"PHP53to54.Deprecated.Functions.Deprecated",5),
        array(10,1,"PHP53to54.Deprecated.Functions.Deprecated",5),
    ),
    // warnings
    array(
    ),
);

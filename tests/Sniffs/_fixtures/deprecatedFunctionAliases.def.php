<?php

return array(
    // fixture
    'deprecated.php',
    // standard
    'php53to54',
    // sniffs
    array('PHP53to54.Deprecated.FunctionAliases'),
    // errors
    array(
        array(3,6,"PHP53to54.Deprecated.FunctionAliases.Deprecated",5),
        array(5,21,"PHP53to54.Deprecated.FunctionAliases.Deprecated",5),
        array(10,1,"PHP53to54.Deprecated.FunctionAliases.Deprecated",5),
    ),
    // warnings
    array(
    ),
);

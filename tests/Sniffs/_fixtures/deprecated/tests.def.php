<?php

return array(
    array(
        // fixture
        'functions.php',
        // standard
        'php53to54',
        // sniffs
        array('PHP53to54.Deprecated.Functions'),
        // errors
        array(
            '8:1' => "PHP53to54.Deprecated.Functions.Deprecated",
            '10:1' => "PHP53to54.Deprecated.Functions.Deprecated",
        ),
        // warnings
        array(
        ),
    ),
    array(
        // fixture
        'functions.php',
        // standard
        'php53to54',
        // sniffs
        array('PHP53to54.Deprecated.FunctionAliases'),
        // errors
        array(
            '3:6' => "PHP53to54.Deprecated.FunctionAliases.Deprecated",
            '5:21' => "PHP53to54.Deprecated.FunctionAliases.Deprecated",
            '10:1' => "PHP53to54.Deprecated.FunctionAliases.Deprecated",
        ),
        // warnings
        array(
        ),
    ),
);

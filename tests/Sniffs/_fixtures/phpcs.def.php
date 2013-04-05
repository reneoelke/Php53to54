<?php

return array(
    array(
        // fixture
        'phpcs.php',
        // standard
        'psr2',
        // sniffs
        array(),
        // errors
        array(
            // long form: line:column => [sniff, severity]
            '5:1' => array("PSR1.Classes.ClassDeclaration.MissingNamespace", 5),
        ),
        // warnings
        array(
            // short form: line:column => sniff
            '1:1' => "PSR1.Files.SideEffects.FoundWithSymbols",
            '10:9' => "Generic.Files.LineLength.TooLong",
        ),
    ),
);

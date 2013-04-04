<?php

return array(
    // fixture
    'phpcs.php',
    // standard
    'psr2',
    // sniffs
    array(),
    // errors
    array(
        // line, column, sniff, severity
        array(5,1,"PSR1.Classes.ClassDeclaration.MissingNamespace",5),
    ),
    // warnings
    array(
        array(1,1,"PSR1.Files.SideEffects.FoundWithSymbols",5),
        array(10,9,"Generic.Files.LineLength.TooLong",5),
    ),
);

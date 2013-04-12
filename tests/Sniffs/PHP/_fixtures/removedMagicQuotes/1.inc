<?php

// invalid calls
get_magic_quotes_runtime();

echo get_magic_quotes_gpc();

// checklist
        'get_magic_quotes_runtime' => null,
        'get_magic_quotes_gpc' => null,
        'set_magic_quotes_runtime' => null,

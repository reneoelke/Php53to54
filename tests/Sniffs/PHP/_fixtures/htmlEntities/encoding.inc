<?php

// valid
htmlentities($variable, null, 'UTF-8');
htmlentities($variable, "anything", 'ISO-8991');

// invalid
htmlentities($variable, null);
htmlentities($variable);
htmlentities($variable, "anything", $encoding); // should throw warning with variable
htmlentities($variable, "anything", ""); // should throw warning

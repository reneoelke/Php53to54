<?php

// valid
htmlentities($variable, null, 'UTF-8');
htmlentities($variable, "anything", 'ISO-8991');

// invalid
htmlentities($variable, null);
htmlentities($variable);
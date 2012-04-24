<?php

// valid
htmlentities($variable, null, 'UTF-8');

// invalid
htmlentities($variable, null, 'GB2312');
htmlentities($variable, null, 'big5-hkscs');
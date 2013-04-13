<?php

// valid
myClass::ini_set('short_open_tag', false);
$obj->ini_set('short_open_tag', false);
$ini_set('short_open_tag', false);
myClass::ini_get('short_open_tag', false);
$obj->ini_get('short_open_tag', false);
$ini_get('short_open_tag', false);

// invalid
ini_set('short_open_tag', false);
ini_set("short_open_tag", false);
ini_get("short_open_tag", false);
ini_get(
    (string)
    /* long comment */
    "short_open_tag"
    ,
    true
);
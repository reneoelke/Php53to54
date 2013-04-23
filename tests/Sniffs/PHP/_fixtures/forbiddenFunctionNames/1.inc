<?php

// valid
class hex2bin {
    function hex2bin() {}
    static function hex2bin() {}
    public function hex2bin() {}
}
interface hex2bin {}
trait hex2bin {}
$hex2bin = function() {};
MyClass::hex2bin();
hex2bin('123');
hex2bin();

// invalid

function /* comment */
    hex2bin
    # 123
// foo
( $bar ) {
    // body
    $is = 1 + 2 - 3 == 0 * hex2bin();

    return true === $is;
}

// checklist
// PHP Core
function hex2bin() {}
function http_response_code() {}
function get_declared_traits() {}
function getimagesizefromstring() {}
function stream_set_chunk_size() {}
function socket_import_stream() {}
function trait_exists() {}
function header_register_callback() {}
function class_uses() {}
function session_status() {}
function session_register_shutdown() {}
function mysqli_error_list() {}
function mysqli_stmt_error_list() {}
function libxml_set_external_entity_loader() {}
function ldap_control_paged_result() {}
function ldap_control_paged_result_response() {}
function transliterator_create() {}
function transliterator_create_from_rules() {}
function transliterator_create_inverse() {}
function transliterator_get_error_code() {}
function transliterator_get_error_message() {}
function transliterator_list_ids() {}
function transliterator_transliterate() {}
function zlib_decode() {}
function zlib_encode() {}

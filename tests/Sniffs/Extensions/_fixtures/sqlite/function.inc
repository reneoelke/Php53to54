<?php

// function (does only test calls)

function sqlite_fetch_object() {}
function SQLite_fetch_object() {}

class foo {
    function sqlite_fetch_object() {}
}
foo::sqlite_fetch_object();
$foo->sqlite_fetch_object();

// checklist
sqlite_array_query();
sqlite_busy_timeout ();
sqlite_changes (/*foo*/);
sqlite_close /** foo */ ();
sqlite_column();
sqlite_create_aggregate();
sqlite_create_function();
sqlite_current();
sqlite_error_string();
sqlite_escape_string();
sqlite_exec();
sqlite_factory();
sqlite_fetch_all();
sqlite_fetch_array();
sqlite_fetch_column_types();
sqlite_fetch_object();
sqlite_fetch_single();
sqlite_fetch_string();
sqlite_field_name();
sqlite_has_more();
sqlite_has_prev();
sqlite_key();
sqlite_last_error();
sqlite_last_insert_rowid();
sqlite_libencoding();
sqlite_libversion();
sqlite_next();
sqlite_num_fields();
sqlite_num_rows();
sqlite_open();
sqlite_popen();
sqlite_prev();
sqlite_query();
sqlite_rewind();
sqlite_seek();
sqlite_single_query();
sqlite_udf_decode_binary();
sqlite_udf_encode_binary();
sqlite_unbuffered_query();
sqlite_valid();

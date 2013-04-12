Detailed feature list
===============================================================================

**This list is currently under _development_**

- [x] new language features are recognised
- [ ] scans are namespace aware (not for `DeprecatedClassNames`)

Known issues
------------

- [ ] tests common namespace for classes, traits and interfaces
- [ ] constant `define()` is always global (namespace or not)
- [ ] warn on ini_get of deprecated key
- [ ] renamed functions not added to forbiddenFunctionNames sniff
- [ ] functions and classes do not share names
- [ ] parameter types and use declarations are not tested for deprecated classnames
- [ ] E_STRICT sniff will issue error when warning seems more appropriate
- [ ] E_STRICT detection is not tested and likely not that useful yet
- [ ] added functions are reported as deprecated (wrong base sniff used)

Deprecated or removed
---------------------

### Class

**sqlite**

- [x] `SQLiteResult`
- [x] `SQLiteUnbuffered`
- [x] `SQLiteDatabase`
        
### Interface 

### Constant

**sqlite**

- [x] `SQLITE_ASSOC`
- [x] `SQLITE_BOTH`
- [x] `SQLITE_NUM`
- [x] `SQLITE_OK`
- [x] `SQLITE_ERROR`
- [x] `SQLITE_INTERNAL`
- [x] `SQLITE_PERM`
- [x] `SQLITE_ABORT`
- [x] `SQLITE_BUSY`
- [x] `SQLITE_LOCKED`
- [x] `SQLITE_NOMEM`
- [x] `SQLITE_READONLY`
- [x] `SQLITE_INTERRUPT`
- [x] `SQLITE_IOERR`
- [x] `SQLITE_NOTADB`
- [x] `SQLITE_CORRUPT`
- [x] `SQLITE_FORMAT`
- [x] `SQLITE_NOTFOUND`
- [x] `SQLITE_FULL`
- [x] `SQLITE_CANTOPEN`
- [x] `SQLITE_PROTOCOL`
- [x] `SQLITE_EMPTY`
- [x] `SQLITE_SCHEMA`
- [x] `SQLITE_TOOBIG`
- [x] `SQLITE_CONSTRAINT`
- [x] `SQLITE_MISMATCH`
- [x] `SQLITE_MISUSE`
- [x] `SQLITE_NOLFS`
- [x] `SQLITE_AUTH`
- [x] `SQLITE_ROW`
- [x] `SQLITE_DONE`

### Function

**generic**

 - [x] `define_syslog_variables`
 - [x] `import_request_variables`: consider using `extract`
 - [x] `session_is_registered`: use `$_SESSION`
 - [x] `session_register`: use `$_SESSION`
 - [x] `session_unregister`: use `$_SESSION`
 - [x] `mcrypt_generic_end`
 - [x] `mysql_list_dbs`

**mysqli**

 - [x] `mysqli_bind_param`: use `mysqli_stmt_bind_param`
 - [x] `mysqli_bind_result`: use `mysqli_stmt_bind_result`
 - [x] `mysqli_client_encoding`: use `mysqli_character_set_name`
 - [x] `mysqli_fetch`: use `mysqli_stmt_fetch`
 - [x] `mysqli_param_count`: use `mysqli_stmt_param_count`
 - [x] `mysqli_get_metadata`: use `mysqli_stmt_result_metadata`
 - [x] `mysqli_send_long_data`: use `mysqli_stmt_send_long_data`

**snmp**

- [x] `snmp_get_quick_print`
- [x] `snmp_get_valueretrieval`
- [x] `snmp_read_mib`
- [x] `snmp_set_enum_print`
- [x] `snmp_set_oid_numeric_print`
- [x] `snmp_set_oid_output_format`
- [x] `snmp_set_quick_print`
- [x] `snmp_set_valueretrieval`
- [x] `snmp2_get`
- [x] `snmp2_getnext`
- [x] `snmp2_real_walk`
- [x] `snmp2_set`
- [x] `snmp2_walk`
- [x] `snmp3_get`
- [x] `snmp3_getnext`
- [x] `snmp3_real_walk`
- [x] `snmp3_set`
- [x] `snmp3_walk`
- [x] `snmpget`
- [x] `snmpgetnext`
- [x] `snmprealwalk`
- [x] `snmpset`
- [x] `snmpwalk`
- [x] `snmpwalkoid`

**sqlite**

- [x] `sqlite_array_query`
- [x] `sqlite_busy_timeout`
- [x] `sqlite_changes`
- [x] `sqlite_close`
- [x] `sqlite_column`
- [x] `sqlite_create_aggregate`
- [x] `sqlite_create_function`
- [x] `sqlite_current`
- [x] `sqlite_error_string`
- [x] `sqlite_escape_string`
- [x] `sqlite_exec`
- [x] `sqlite_factory`
- [x] `sqlite_fetch_all`
- [x] `sqlite_fetch_array`
- [x] `sqlite_fetch_column_types`
- [x] `sqlite_fetch_object`
- [x] `sqlite_fetch_single`
- [x] `sqlite_fetch_string`
- [x] `sqlite_field_name`
- [x] `sqlite_has_more`
- [x] `sqlite_has_prev`
- [x] `sqlite_key`
- [x] `sqlite_last_error`
- [x] `sqlite_last_insert_rowid`
- [x] `sqlite_libencoding`
- [x] `sqlite_libversion`
- [x] `sqlite_next`
- [x] `sqlite_num_fields`
- [x] `sqlite_num_rows`
- [x] `sqlite_open`
- [x] `sqlite_popen`
- [x] `sqlite_prev`
- [x] `sqlite_query`
- [x] `sqlite_rewind`
- [x] `sqlite_seek`
- [x] `sqlite_single_query`
- [x] `sqlite_udf_decode_binary`
- [x] `sqlite_udf_encode_binary`
- [x] `sqlite_unbuffered_query`
- [x] `sqlite_valid`

### Method

### Parameter

### INI directives

**generic**

- [x] `magic_quotes_runtime`
- [x] `magic_quotes_sybase`
- [x] `define_syslog_variables`
- [x] `highlight.bg`
- [x] `session.bug_compat_42`
- [x] `session.bug_compat_warn`
- [x] `y2k_compliance`
- [x] `short_open_tag`

**safe mode**

- [x] `safe_mode`
- [x] `safe_mode_gid`
- [x] `safe_mode_include_dir`
- [x] `safe_mode_exec_dir`
- [x] `safe_mode_allowed_env_vars`
- [x] `safe_mode_protected_env_vars`

### Extension

- [x] `sqlite` (sqlite3 is still available)
 
### `E_ALL` includes `E_STRICT`

- [x] detects `error_reporting(E_ALL | ESTRICT)`

Added
-----

### Class

- [x] `CallbackFilterIterator`
- [x] `RecursiveCallbackFilterIterator`
- [x] `ReflectionZendExtension`
- [x] `SessionHandler`
- [x] `SNMP`
- [x] `Transliterator`
- [x] `Spoofchecker`

### Constant

- [x] `ENT_DISALLOWED`
- [x] `ENT_HTML401`
- [x] `ENT_HTML5`
- [x] `ENT_SUBSTITUTE`
- [x] `ENT_XML1`
- [x] `ENT_XHTML`
- [x] `IPPROTO_IP`
- [x] `IPPROTO_IPV6`
- [x] `IPV6_MULTICAST_HOPS`
- [x] `IPV6_MULTICAST_IF`
- [x] `IPV6_MULTICAST_LOOP`
- [x] `IP_MULTICAST_IF`
- [x] `IP_MULTICAST_LOOP`
- [x] `IP_MULTICAST_TTL`
- [x] `MCAST_JOIN_GROUP`
- [x] `MCAST_LEAVE_GROUP`
- [x] `MCAST_BLOCK_SOURCE`
- [x] `MCAST_UNBLOCK_SOURCE`
- [x] `MCAST_JOIN_SOURCE_GROUP`
- [x] `MCAST_LEAVE_SOURCE_GROUP`
- [x] `CURLOPT_MAX_RECV_SPEED_LARGE`
- [x] `CURLOPT_MAX_SEND_SPEED_LARGE`
- [x] `LIBXML_HTML_NODEFDTD`
- [x] `LIBXML_HTML_NOIMPLIED`
- [x] `LIBXML_PEDANTIC`
- [x] `OPENSSL_CIPHER_AES_128_CBC`
- [x] `OPENSSL_CIPHER_AES_192_CBC`
- [x] `OPENSSL_CIPHER_AES_256_CBC`
- [x] `OPENSSL_RAW_DATA`
- [x] `OPENSSL_ZERO_PADDING`
- [x] `PHP_OUTPUT_HANDLER_CLEAN`
- [x] `PHP_OUTPUT_HANDLER_CLEANABLE`
- [x] `PHP_OUTPUT_HANDLER_DISABLED`
- [x] `PHP_OUTPUT_HANDLER_FINAL`
- [x] `PHP_OUTPUT_HANDLER_FLUSH`
- [x] `PHP_OUTPUT_HANDLER_FLUSHABLE`
- [x] `PHP_OUTPUT_HANDLER_REMOVABLE`
- [x] `PHP_OUTPUT_HANDLER_STARTED`
- [x] `PHP_OUTPUT_HANDLER_STDFLAGS`
- [x] `PHP_OUTPUT_HANDLER_WRITE`
- [x] `PHP_SESSION_ACTIVE`
- [x] `PHP_SESSION_DISABLED`
- [x] `PHP_SESSION_NONE`
- [x] `STREAM_META_ACCESS`
- [x] `STREAM_META_GROUP`
- [x] `STREAM_META_GROUP_NAME`
- [x] `STREAM_META_OWNER`
- [x] `STREAM_META_OWNER_NAME`
- [x] `STREAM_META_TOUCH`
- [x] `ZLIB_ENCODING_DEFLATE`
- [x] `ZLIB_ENCODING_GZIP`
- [x] `ZLIB_ENCODING_RAW`
- [x] `U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR`
- [x] `IDNA_CHECK_BIDI`
- [x] `IDNA_CHECK_CONTEXTJ`
- [x] `IDNA_NONTRANSITIONAL_TO_ASCII`
- [x] `IDNA_NONTRANSITIONAL_TO_UNICODE`
- [x] `INTL_IDNA_VARIANT_2003`
- [x] `INTL_IDNA_VARIANT_UTS46`
- [x] `IDNA_ERROR_EMPTY_LABEL`
- [x] `IDNA_ERROR_LABEL_TOO_LONG`
- [x] `IDNA_ERROR_DOMAIN_NAME_TOO_LONG`
- [x] `IDNA_ERROR_LEADING_HYPHEN`
- [x] `IDNA_ERROR_TRAILING_HYPHEN`
- [x] `IDNA_ERROR_HYPHEN_3_4`
- [x] `IDNA_ERROR_LEADING_COMBINING_MARK`
- [x] `IDNA_ERROR_DISALLOWED`
- [x] `IDNA_ERROR_PUNYCODE`
- [x] `IDNA_ERROR_LABEL_HAS_DOT`
- [x] `IDNA_ERROR_INVALID_ACE_LABEL`
- [x] `IDNA_ERROR_BIDI`
- [x] `IDNA_ERROR_CONTEXTJ`
- [x] `JSON_PRETTY_PRINT`
- [x] `JSON_UNESCAPED_SLASHES`
- [x] `JSON_NUMERIC_CHECK`
- [x] `JSON_UNESCAPED_UNICODE`
- [x] `JSON_BIGINT_AS_STRING`

### Interface

- [x] `JsonSerializable`
- [x] `SessionHandlerInterface`

### Function

**generic**

- [ ] `hex2bin()`
- [ ] `http_response_code()`
- [ ] `get_declared_traits()`
- [ ] `getimagesizefromstring()`
- [ ] `stream_set_chunk_size()`
- [ ] `socket_import_stream()`
- [ ] `trait_exists()`
- [ ] `header_register_callback()`

**spl**

- [ ] `class_uses()`

**session**

- [ ] `session_status()`
- [ ] `session_register_shutdown()`

**mysqli**

- [ ] `mysqli_error_list()`
- [ ] `mysqli_stmt_error_list()`

**libxml**

- [ ] `libxml_set_external_entity_loader()`

**ldap**

- [ ] `ldap_control_paged_result()`
- [ ] `ldap_control_paged_result_response()`

**intl**

- [ ] `transliterator_create()`
- [ ] `transliterator_create_from_rules()`
- [ ] `transliterator_create_inverse()`
- [ ] `transliterator_get_error_code()`
- [ ] `transliterator_get_error_message()`
- [ ] `transliterator_list_ids()`
- [ ] `transliterator_transliterate()`

**zlib**

- [ ] `zlib_decode()`
- [ ] `zlib_encode()`

### Method

### Parameter

### Extension

Language features
-----------------

### Keyword

- [ ] `callable`
- [ ] `insteadof`
- [ ] `trait`

### CallTimePassByReference

- [x] static method
- [x] non-static method
- [x] function
- [x] closure
 
### Break/ Continue

- [x] variable argument
- [ ] non-integer argument
- [ ] integer less than one
- [ ] ignore comments and brackets
- [ ] ignore integer strings (if greater than zero)

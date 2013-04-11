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

Deprecated or removed
---------------------

### Class

### Interface 

### Constant

### Function

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

- [x] `safe_mode'`
- [x] `safe_mode_gid'`
- [x] `safe_mode_include_dir'`
- [x] `safe_mode_exec_dir'`
- [x] `safe_mode_allowed_env_vars'`
- [x] `safe_mode_protected_env_vars'`


### Extension

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

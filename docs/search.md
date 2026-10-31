# Literal and multiline search

## Behavior

Both built-in engines inspect a complete string leaf rather than splitting the
field before matching. A match can cross any number of lines. Separate fields or
array leaves are never joined to fabricate a match.

| Setting | Behavior |
| --- | --- |
| `search_value` | Literal text for Basic; a raw, undelimited PCRE expression for Regex. `"0"` is a valid query. Null/empty queries have no matches. |
| `ignore_whitespace` | Defaults to `1` for Basic. Leading/trailing query whitespace is ignored, and each internal whitespace run matches one or more whitespace characters, including line breaks. Set `0` for exact text and line endings. Regex always follows its own expression. |
| `match_case` | `1` enables case-sensitive matching; `0` is case-insensitive, as before. |
| `whole_word` | Basic constrains word-character endpoints to avoid partial identifiers. Punctuation endpoints do not need artificial word boundaries: `->method` finds `$object->method`, while excluding `->methods`. Regex authors express their own boundaries. |
| `replace_value` | Basic inserts this text literally, including dollars and backslashes. Regex expands PHP's numbered replacement references such as `$1`, `${1}`, and `\1`. |

Flexible whitespace does **not** erase separators: `alpha beta` matches
`alpha\t\tbeta` or `alpha\r\n    beta`, but does not match `alphabeta`.
It does not insert optional gaps where the query has none or tokenize/minify PHP.
This deliberately keeps different identifiers from becoming the same query.
Blank-only flexible queries are rejected as empty searches; exact mode can search
literal whitespace. Whitespace and word classes retain PCRE's byte-oriented
semantics; these classes are not a Unicode normalization or language parser.

Regex `m` anchors now recognize all physical newlines handled by the legacy
`\R` splitter, including CRLF and CR. Dot does not cross a line break unless the
expression enables it with `(?s)`. A PCRE newline directive supplied at the start
of the expression can override the default `(*ANY)`. Capture numbering is no
longer shifted by an extra wrapper group. Raw URLs need no escaped slash solely
to accommodate the engine delimiter. The engine chooses a delimiter absent from
the expression; a pathological expression containing every supported punctuation
and control delimiter throws rather than silently changing its meaning. Encode
literal control characters with PCRE hexadecimal escapes in that case.

Invalid regexes throw `InvalidArgumentException` at construction. Runtime PCRE
failures, including resource limits, throw `RuntimeException`. Callers should
surface those errors and stop the operation. Bulk database writes are per batch,
not a transaction spanning every table: an error in a later batch does not roll
back earlier successfully persisted batches.

## API and source preservation

`Basic` and `Regex` explicitly implement the optional
[`DocumentSearchInterface`](../src/33f11e5c-7055-4a7a-90ed-2f456b578674/README.md),
which extends the unchanged `SearchTypeInterface`.

| Method | Result |
| --- | --- |
| `match($value)` | Whether a match exists; does not change counters. |
| `string($value)` | Complete original string with literal markers, or null. Retains whitespace and counts one call, preserving the original counter hook. |
| `lines($value)` | Marked source snippets indexed by **one-based starting line**, or null. Counts every physical line once. |
| `replace($value)` | Complete updated value. |
| `replaceLine($value, $line)` | Replace matches **beginning** on that original line, including their continuation onto later lines. An invalid/out-of-range line leaves the input unchanged. |

Multiple non-overlapping matches starting on the same line share one result and
are replaced together. Each snippet includes complete original source lines
through the end of its matches; only matches starting on its keyed line are
marked. A continuation line is not another independently replaceable result.
Line separators outside replaced spans remain byte-identical. Replacement text
is not searched again. Markers are literal strings, not safe HTML: existing output
escaping remains necessary.

Example in a compiled consumer with the repository's preview namespace:

```php
use Joomla\Input\Input;
use VDM\Joomla\Componentbuilder\Search\Config;
use VDM\Joomla\Componentbuilder\Search\Engine\Basic;

$config = new Config(new Input([
    'search_value' => 'alpha beta',
    'replace_value' => 'done',
    'ignore_whitespace' => 1,
    'match_case' => 1,
]));
$engine = new Basic($config);
$source = "before\r\n  alpha\r\n\tbeta;\r\nalpha beta";

$results = $engine->lines($source); // Keys 2 and 4.
$updated = $engine->replaceLine($source, 2);
// "before\r\n  done;\r\nalpha beta"
```

Configure an engine before constructing it; its compiled pattern, replacement
and markers are snapshots of that configuration. Construct a new engine when
changing a query or its options.

`Agent\Search` keeps the established table/item/field/line result shape.
`Agent\Update::value($value, 0)` or a null target replaces all matches; a positive
line replaces matches starting on that line. Nested arrays are traversed without
the former four-level limit. Result paths still use dot-separated array keys plus
a final line number. Literal dots and backslashes within keys are escaped as
`\.` and `\\`, respectively, and decoded by Update. Key `0` is a real key;
malformed paths and incomplete paths do not update neighboring fields. Recursive
values are intended for acyclic arrays, such as decoded JSON/subforms.

Custom engines implementing only `SearchTypeInterface`, including subclasses of
the existing `Abstraction\Engine`, retain the per-line agent fallback. Only classes
explicitly implementing `DocumentSearchInterface` opt in to document matching.
The existing `Update::validateUpdateKey` subclass hook remains active on nested
leaves, with its original first four key arguments; deeper traversal and exact
path selection are handled separately.

## Bug fixes included

- Literal and regex searches accept the string `"0"`.
- Literal replacement text and highlight markers cannot accidentally expand
  capture references; original whitespace is retained in marked values.
- Regex capture numbering, raw delimiters, and newline anchors work consistently.
- Selected replacements retain CRLF, CR, LF and other original separators.
- Deep arrays, numeric zero keys, omitted line targets and repeated searches are
  handled consistently, without stale fields in result buckets.
- Paginated database scans sort by ID to match their ID cursor, advance from raw
  rows before modeling, and continue past fully filtered batches.
- Item lists use actual record IDs instead of list positions, and integer IDs
  survive the load model's validation.
- Insert model metadata includes its required `StringHelper` dependency.

## Superpowers integration and validation

Authoring follows `joomengine/ai-doc` at
`b54c061cdb74ad2a2bcb1dffbebbf6ff1883eefd`. Existing identities, namespace
placeholders, service names, and public method parameter names are preserved.
The new interface's UUIDv4 was checked against all seven registered repository
indexes (366 powers) and the local index. Updated code bodies and PHP previews
are synchronized. Feature powers use version `1.1.0`; independent bugfix powers
use `1.0.1`; the new interface starts at `1.0.0`.

The implementation uses PHP 7.4-compatible language constructs; local execution
was verified on **PHP 8.3.6**. A full Joomla/JCB import/compile has not been run.
The test harness uses explicit dependency doubles and does not prove real database
or Joomla runtime integration. One existing Agent body has compiler placeholders,
so the static validator explicitly defers that body comparison to JCB.

Before deployment, configure the desired repository branch in an isolated JCB
instance, refresh existing affected Power records (fetching Git alone does not
refresh already-imported records), import the new interface, and compile a
representative consumer. Verify the `Search` service with both Basic and Regex,
namespace/autoload resolution, database pagination and selected replacements.
The consumer's search input must be capable of submitting multiline raw text;
this class repository does not contain or change that form/UI.

Run the dependency-free regression suite with `php -n tests/run.php`.
[Tests and optional performance workload](../tests/README.md) document what is
executed and the limits of the stand-in dependencies.

### JCB! Power
# interface DocumentSearchInterface

Namespace: **VDM\Joomla\Componentbuilder\Search\Interfaces**

This optional extension of `SearchTypeInterface` lets an engine search an entire
field value and report matches that cross line boundaries. Existing custom engines
can continue to implement only `SearchTypeInterface`; callers detect this additional
capability before using it.

| Method | Contract |
| --- | --- |
| `lines(string $value): ?array` | Return marked source snippets keyed by their one-based starting line, or `null` when no match exists. A snippet includes all lines crossed by its matches; matches starting on the same line share a result. |
| `replaceLine(string $value, int $line): string` | Replace matches starting on the selected original line, including their continuation onto later lines. Preserve content outside those matches. |
| `string(string $value): ?string` | Inherited marked-string search contract. |
| `replace(string $value): string` | Inherited whole-value replacement contract. |

The built-in engines treat CRLF, LF and CR as line endings. Returned markers follow
the engine's configured start/end markers and do not turn source content into safe
HTML; consumers remain responsible for output escaping.

The interface depends on [SearchTypeInterface](../117d8c9e-3f8d-40ae-b375-1efa2fe5538a)
through `extendsinterfaces`. Its portable namespace retains both JCB placeholders.
The assembled PHP uses the repository's `VDM` / `Componentbuilder` preview context.

Power version: `1.0.0`. It adds no requirements to the existing base interface.

Use this active token in JCB source:

```php
Super___33f11e5c_7055_4a7a_90ed_2f456b578674___Power
```

The index/display key is
`Super---33f11e5c_7055_4a7a_90ed_2f456b578674---Power`.

# Search regression checks

Run from the repository root with PHP 8.0 or newer:

```sh
php -n tests/run.php
```

The runner executes the same behavior checks twice, once against the exported
`code.php` classes and once against the authoritative `code.power` bodies. The
second pass uses the exported class declarations and imports; it is not a full
JCB compiler. The Superpowers metadata validator from `joomengine/ai-doc` remains
a separate check.

These tests need no Composer packages, database, or Joomla installation. Small,
explicit doubles stand in for Joomla input, the external registry and utility
classes, and the database/model dependencies. The actual local search engines,
agents, and selected database/model classes are loaded through
`super-powers.json`. No production database or network service is contacted.

Coverage includes literal and regex modes, matching `0`, case and word options,
multiline spans, flexible/exact whitespace, source line numbers, literal marking,
regex replacement captures and lookarounds, PCRE failures, line-ending
preservation, deep subforms and escaped paths, legacy engines, database pagination,
record identities, and reusable agent state.

To run one source format while developing:

```sh
php -n tests/run.php php
php -n tests/run.php power
```

An optional microbenchmark reports elapsed time for single lines and a 190 KB
multiline document:

```sh
php -n tests/benchmark.php
```

Timings depend on the PHP version, machine, and input. This benchmark is diagnostic
and does not impose a timing threshold on the regression suite.

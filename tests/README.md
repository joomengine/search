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

# Real JCB playground integration

`tests/playground.php` exercises compiled Superpowers inside the real Joomla
runtime. It contains no dependency doubles and makes no database mutations: its
20 behavior checks use in-memory fixtures, and one structural check reflects all
25 powers in this repository. The active `Super___...___Power` references let JCB
resolve their dependencies during compilation.

The intended validation environment is the **Demo J6** component in the Joomla 6
playground, compiled with JCB 6.2. Live execution of this harness has **not yet
been verified**. The report records the actual PHP and Joomla versions; local
regression-test results do not establish that this separate integration run has
passed.

1. Configure the search Superpower repository to import
   `joomengine/search`, branch `feature/multiline-whitespace-search`, and import
   its 25 powers. Include the new `DocumentSearchInterface` and the existing
   dependency graph.
2. Open the Custom Admin View **Importer Engine (Queue)** linked to **Demo J6**.
   In the current playground these are view ID 21 and component ID 92; IDs can
   differ in another installation.
3. In the view's **PHP** tab, use the enabled **Custom Script** field
   (`jform_php_view`). Retain its existing code, including:

   ```php
   $this->app->getInput()->set('hidemainmenu', false);
   ```

   Append the contents of `tests/playground.php`, omitting only its opening
   `<?php` tag. Keep the final `echo $integrationReportHtml;` because this field
   accepts executable statements before rendering the view.
4. Save the view, compile **Demo J6**, and install the newly compiled component in
   the same playground. Saving the JCB source alone does not update the installed
   Demo runtime.
5. Open the installed administrator view:
   `administrator/index.php?option=com_demo&view=importer`.
6. Inspect the heading and the JSON inside `#search-integration-results`. A
   successful run reports **21 passed, 0 failed**. Preserve that JSON as execution
   evidence rather than inferring success from compilation alone.

The report includes the expected source branch, PHP/Joomla versions, and all 25
reflected class names, GUIDs, types, files, SHA-256 hashes, modification times, and
relevant methods. The structural check requires the compiled `Demo\Search`
namespace and real files, rejects host `com_componentbuilder` files, and verifies
class/interface/abstract-class types. It does not hard-code a library location:
JCB's power path is configurable, and this Demo seed uses `libraries/jcb_demo`.
The expected branch label documents the requested source; it does not independently
prove which Git commit was imported. Keep the import/compile provenance alongside
the runtime JSON.

The fixtures cover whitespace options, multiline spans and start lines, selected
replacement, literal metacharacters, regex captures/errors/anchors/lookarounds,
deep subforms, numeric-zero and escaped paths, stale results, and autoloading of
the complete repository. They do not exercise real database persistence or claim
to replace a complete JCB component acceptance test. Remove only the appended
harness block and recompile/reinstall when the temporary integration display is
no longer wanted.

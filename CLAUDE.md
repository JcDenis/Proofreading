# Proofreading

Notes for AI assistants working on the Dotclear plugin Proofreading.

**Read first** the shared conventions of the author's Dotclear modules:
https://raw.githubusercontent.com/JcDenis/gh2da/master/CONVENTIONS.md
(if a web tool refuses the address, use `curl -s` on it from the shell).
The rules below take precedence for this module.

## Module

Add proofreading statuses for your posts.

No admin page. Public side: only the statuses given to ClaudetteMcp.

Required Dotclear and PHP versions: see `_define.php`.

## Structure

* `src/My.php`: module helpers (`My::id()`, settings, permissions).
* `src/Prepend.php`: loaded on every request: the three post statuses.
* `src/Frontend.php`: gives the statuses to the plugin ClaudetteMcp (behavior `ClaudetteMcpAddPostStatus`, ClaudetteMcp 0.5+), never required.

## Pitfalls

* None recorded yet: add here the traps met while working on the module.

## Testing

* CI browses the common admin and public pages; extra pages can be listed in `.github/dotclear-test.txt`.

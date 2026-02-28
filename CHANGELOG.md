# Changelog

All notable changes to this project will be documented in this file.

## [2.0.4] - Current
### Changed
- Updated all Composer dependencies to their latest versions:
  - `guzzlehttp/guzzle`: 6.3.0 → 7.10.0 (fixes multiple security vulnerabilities)
  - `guzzlehttp/psr7`: 1.4.2 → 2.8.0
  - `guzzlehttp/promises`: 1.3.1 → 2.3.0
  - `illuminate/support`: 5.5.2 → 12.53.0
  - `wa72/htmlpagedom`: 1.3.0 → 3.1.0
  - `railken/bag`: 1.2.5 → 2.0.1
  - `nesbot/carbon`: 1.22.1 → 3.11.1
  - `symfony/*`: 3.3.x → 7.4.x
  - `phpunit/phpunit` (dev): 5.7.22 → 12.5.14 (fixes unsafe deserialization vulnerability)
- Updated bundled PHP Simple HTML DOM Parser to upstream 1.9.1 (all `ums_` prefix and WordPress filesystem customisations preserved).
- Replaced abandoned `eventviva/php-image-resize` bundled library with its successor `gumlet/php-image-resize` 2.1.3 (`namespace Gumlet`; `ImageResizeException` moved to its own file).
- Pre-built vendor directory committed; users no longer need to run `composer install`.
- Updated minimum PHP requirement from 7.4 to 8.2 to match latest library requirements.
- Updated `ums_get_random_user_agent()` Chrome version range from 81–108 (2020) to 124–136 (current) and macOS range to 13–15 (Ventura–Sequoia).
- Updated hardcoded Chrome 83/102 UA strings in fanfox cURL headers and translator to Chrome 136.
- Replaced `extract($ratings)` with explicit variable assignments to eliminate variable-injection risk.
- Converted legacy `array()` constructor syntax to short `[]` in translator.
- Replaced blocking busy-wait `ums_sleepFor()`/`ums_wait()` in `scripts/footer.js` with `setTimeout`-based async retry, freeing the browser's main thread.
- Replaced all `var` declarations with `const`/`let` in `scripts/footer.js` and `scripts/main.js`.
- Removed dead code: duplicate `var classes`, unused array initialisations in `createAdmin()`, and commented-out retry logic.

## [2.0.3]
### Added
- Released into Public Domain (Nulled/Free version).
- Included Madara Enhancements.

## [2.0.2]
### Fixed
- Bugfixes and performance improvements.

## [1.0]
### Added
- Initial release.

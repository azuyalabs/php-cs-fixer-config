# Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html) and
[Conventional Commits](https://conventionalcommits.org) for commit conventions.

## [0.3.6] - 2026-07-30

### Refactor

- Replace annotations with attributes in tests

### Documentation

- (Changelog) Update changelog with latest changes
- Change link to GitHub's vulnerability reporting
- Update project description
- Update CODE_OF_CONDUCT to Contributor Covenant v3.0

### Other

- Bump composer package versions to latest installed versions
- Remove Psalm static analysis tool
- Drop PHP 8.1 support
- Correct minimum PHP version for Rector
- (Rector) Update configuration to latest syntax
- Update .editorconfig settings
- (Cliff) Update git-cliff configuration and regenerate changelog

## [0.3.5] - 2025-07-13

### Other

- Bump composer package versions to latest installed versions

## [0.3.4] - 2025-04-30

### Documentation

- (Readme) Add contributing and license sections

### Other

- Upgrade PHPStan to v2.0
- Remove PHP 7.4 requirement

## [0.3.3] - 2025-03-24

### Refactor

- Remove unnecessary parentheses

### Documentation

- Move DCO fulltext to its own file
- Add Code of Conduct text
- (Changelog) Add changelog using git-cliff

### Other

- Remove Phan static analysis tool
- (Changelog) Revert order of releases to chronological
- (Changelog) Use macro to generate remote url

## [0.3.2] - 2025-02-16

### Refactor

- Add check if reading the composer.json file fails

### Other

- Fix copyright header with correct package name
- Upgrade Psalm

## [0.3.1] - 2024-12-12

### Refactor

- Remove deprecated PHP-CS-Fixer option

### Documentation

- Add installation and usage instructions

### Other

- Add Psalm settings to stop warnings
- Remove deprecated PHPStan option

## [0.3.0] - 2024-04-08

### Features

- Allow rules to be overridden or individually changed

## [0.2.2] - 2024-02-09

### Refactor

- Remove risky DateTimeImmutable rule as it causes code to break in downstream projects

## [0.2.1] - 2024-02-05

### Fixes

- The 'header' option is a required option; remove the rule entirely instead

## [0.2.0] - 2024-02-05

### Features

- Have option to fix code styling without header comment injected

## [0.1.2] - 2024-02-05

### Refactor

- Correct how the package, organization and inception year are determined and defaulted

### Code Style

- Set rector config to scan unit tests as well

## [0.1.1] - 2024-01-31

### Code Style

- Set header description without any formatting. Add rule for always using DateTimeImmutable class

## [0.1.0] - 2024-01-30

### Fixes

- Load the header from the vendor directory instead from the project's root

### Refactor

- Make the header copyright years dynamic to allow to set a start year. Embed the header to avoid projects not able to find the header file
- Make first word of the description lowercase

### Code Style

- Fix formatting issues and use file to render header comment
- Move variable closer to the related following code block
- Fix formatting issues and use file to render header comment
- Move variable closer to the related following code block
- Enable fixer that adds a space with concatenation

### Testing

- Add unit tests using PHPUnit

### Other

- Initial commit
- Initial commit
- Exclude vendor directory
- Exclude PHP CS Fixer cached file and add default Composer scripts
- Add source files and initial PHP CS Fixer configuration
- Add editorconfig to set consistent code styling and formatting settings
- Remove unused package and fix formatting issues
- Exclude phpactor configuration and resort ignore list
- Add code analysis packages and their configuration files
- Exclude phpactor configuration and resort ignore list
- Add code analysis packages and their configuration files
- Include git attributes file
- Replace deprecated PER ruleset with PER-CS
- Shorten the PHP CS fix script and add a script to perform a dry-run
- Remove obsolete header file and references to it
- Fix code style issues and remove old header comment
- Add rules for PHPUnit, normalizing equal sign and array indentation. Fix code style issues
- Remove obsolete header file

[0.3.6]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.5..0.3.6
[0.3.5]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.4..0.3.5
[0.3.4]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.3..0.3.4
[0.3.3]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.2..0.3.3
[0.3.2]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.1..0.3.2
[0.3.1]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.0..0.3.1
[0.3.0]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.2.2..0.3.0
[0.2.2]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.2.1..0.2.2
[0.2.1]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.2.0..0.2.1
[0.2.0]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.1.2..0.2.0
[0.1.2]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.1.1..0.1.2
[0.1.1]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.1.0..0.1.1


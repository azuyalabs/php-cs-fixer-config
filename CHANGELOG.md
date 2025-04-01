# Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html) and
[Conventional Commits](https://conventionalcommits.org) for commit conventions.

## [unreleased]

### Documentation

- (Readme) Add contributing and license sections

### Other

- Remove PHP 7.4 requirement
- Upgrade PHPStan to v2.0

## [0.3.3] - 2025-03-24

### Refactor

- Remove unnecessary parentheses

### Documentation

- (Changelog) Add changelog using git-cliff
- Add Code of Conduct text
- Move DCO fulltext to its own file

### Other

- (Changelog) Use macro to generate remote url
- (Changelog) Revert order of releases to chronological
- Remove Phan static analysis tool

## [0.3.2] - 2025-02-16

### Refactor

- Add check if reading the composer.json file fails

### Other

- Upgrade Psalm
- Fix copyright header with correct package name

## [0.3.1] - 2024-12-12

### Refactor

- Remove deprecated PHP-CS-Fixer option

### Documentation

- Add installation and usage instructions

### Other

- Remove deprecated PHPStan option
- Add Psalm settings to stop warnings

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

- Make first word of the description lowercase
- Make the header copyright years dynamic to allow to set a start year. Embed the header to avoid projects not able to find the header file

### Code Style

- Enable fixer that adds a space with concatenation
- Move variable closer to the related following code block
- Fix formatting issues and use file to render header comment

### Testing

- Add unit tests using PHPUnit

### Other

- Remove obsolete header file
- Add rules for PHPUnit, normalizing equal sign and array indentation. Fix code style issues
- Fix code style issues and remove old header comment
- Remove obsolete header file and references to it
- Shorten the PHP CS fix script and add a script to perform a dry-run
- Replace deprecated PER ruleset with PER-CS
- Include git attributes file
- Add code analysis packages and their configuration files
- Exclude phpactor configuration and resort ignore list
- Remove unused package and fix formatting issues
- Add editorconfig to set consistent code styling and formatting settings
- Add source files and initial PHP CS Fixer configuration
- Exclude PHP CS Fixer cached file and add default Composer scripts
- Exclude vendor directory
- Initial commit

[unreleased]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.3..HEAD
[0.3.3]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.2..0.3.3
[0.3.2]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.1..0.3.2
[0.3.1]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.3.0..0.3.1
[0.3.0]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.2.2..0.3.0
[0.2.2]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.2.1..0.2.2
[0.2.1]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.2.0..0.2.1
[0.2.0]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.1.2..0.2.0
[0.1.2]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.1.1..0.1.2
[0.1.1]: https://github.com/azuyalabs/php-cs-fixer-config/compare/0.1.0..0.1.1


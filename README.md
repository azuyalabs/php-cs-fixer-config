# php-cs-fixer-config

PHP CS Fixer config for AzuyaLabs projects

## Installation

Run

```shell
composer require --dev azuyalabs/php-cs-fixer-config
```

## Usage

### Configuration

If not present, create a configuration file `.php-cs-fixer.php` in the root of
your project with the following contents:

```php
<?php

declare(strict_types=1);

$config = new AzuyaLabs\PhpCsFixerConfig\Config();
$config->getFinder()->in(__DIR__);

return $config;
```

If it already exists, ensure to update it like above.

You can also override any of the default rules like this if you like to do so:

```php
<?php

declare(strict_types = 1);

$config = new AzuyaLabs\PhpCsFixerConfig\Config();
$config->getFinder()->in(__DIR__);

$defaults = $config->getRules();

$config->setRules(array_merge($defaults, [
    '@Symfony' => false,
]));

return $config;
```

Add two helper scripts to the Composer configuration file:

```json
  ...
"scripts": {
"cs": "vendor/bin/php-cs-fixer fix -v --diff --dry-run",
"cs-fix": "vendor/bin/php-cs-fixer fix -v",
}
...
```

### Git

Add `.php-cs-fixer.cache` (this is the cache file created by `php-cs-fixer`) to `.gitignore`:

```gitignore
.php-cs-fixer.cache
vendor/
```

### GitLab CI/CD

If you have included the two helper scripts in your `composer.json` file, you can use those in the GitLab CI
configuration of your project.

To add a job that will check the Code Style settings as part of your test stage, include this in your `.gitlab-ci.yml`
file:

```yaml
cs-check:
    stage: test
    script:
        - composer cs
```

In case you don't want or have the helper Composer script, replace the above `composer cs` script
with `vendor/bin/php-cs-fixer fix -v --diff --dry-run`

## Fixing Code Style issues

### Manually

If you need to fix code styling issues locally, just run:

```shell
composer cs-fix
```

Use `composer cs` to do a dry-run.

### Automatically

For those who like to have code styling issues fixed automatically, you can
opt to create a Git pre-commit hook, or have your IDE configured to utilize
the PHPCS Fixer binary or the configred Composer scripts.

## Code Style

This custom configuration is based on the @PER-CS and @Symfony rulesets, with
a few additional enabled rules (e.g. concerning spaces, etc.).

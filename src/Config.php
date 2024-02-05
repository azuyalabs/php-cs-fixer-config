<?php

declare(strict_types = 1);

/**
 * This file is part of the 'php-cs-fixer-config' package.
 *
 * PHP CS Fixer config for AzuyaLabs projects.
 *
 * Copyright (c) 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace AzuyaLabs\PhpCsFixerConfig;

use PhpCsFixer\Config as PhpCsFixerConfig;

final class Config extends PhpCsFixerConfig
{
    private const ORG = 'AzuyaLabs';

    private const BIRTH_YEAR = '2015';

    private const COMPOSER_FILENAME = 'composer.json';

    private const UNKNOWN_VALUE = 'unknown';

    private bool $hasHeaderComment = true;

    public function __construct(
        private ?string $yr = null,
        private ?string $org = null,
        private ?string $pkg = null,
    ) {
        parent::__construct(self::ORG);

        $this->setRiskyAllowed(true);
    }

    public function getRules(): array
    {
        $rules = [
            '@PER-CS' => true,
            '@Symfony' => true,
            'combine_consecutive_issets' => true,
            'combine_consecutive_unsets' => true,
            'explicit_string_variable' => true,
            'no_superfluous_elseif' => true,
            'no_superfluous_phpdoc_tags' => ['remove_inheritdoc' => true],
            'not_operator_with_successor_space' => true,
            'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => true],
            'ordered_class_elements' => true,
            'header_comment' => ['comment_type' => 'PHPDoc'],
            'concat_space' => ['spacing' => 'one'],
            'declare_equal_normalize' => ['space' => 'single'],

            // risky
            'array_indentation' => true,
            'date_time_immutable' => true,
            'declare_strict_types' => true,
            'dir_constant' => true,
            'get_class_to_class_keyword' => true,
            'is_null' => true,
            'modernize_strpos' => true,
            'modernize_types_casting' => true,
            'self_accessor' => true,

            // phpunit
            'php_unit_method_casing' => ['case' => 'snake_case'],
        ];

        if ($this->hasHeaderComment) {
            $rules['header_comment'] = $this->headerComment($rules['header_comment']);
        } else {
            unset($rules['header_comment']);
        }

        return $rules;
    }

    public function skipHeaderComment(): void
    {
        $this->hasHeaderComment = false;
    }

    private function headerComment(array $rules): array
    {
        if (! \is_readable(self::COMPOSER_FILENAME)) {
            throw new \RuntimeException(sprintf('unable to read %s file', self::COMPOSER_FILENAME));
        }

        $header = <<<'HDR'
        This file is part of the '%package%' package.

        %description%.

        Copyright (c) %years% %org%

        For the full copyright and license information, please view the LICENSE
        file that was distributed with this source code.

        @author Sacha Telgenhof <me at sachatelgenhof dot com>
        HDR;

        $cmp = \json_decode(\file_get_contents(self::COMPOSER_FILENAME));

        $description = $cmp->description ?? self::UNKNOWN_VALUE;
        [$org, $pkg] = explode('/', $cmp->name);

        if (null !== $this->pkg && '' !== $this->pkg && '0' !== $this->pkg) {
            $pkg = $this->pkg;
        }

        if (null === $this->org || '' === $this->org) {
            $org = ($org === strtolower(self::ORG)) ? self::ORG : $org;
        } else {
            $org = $this->org;
        }

        $header = \str_replace(
            [
                '%org%',
                '%package%',
                '%description%',
                '%years%',
            ],
            [
                $org,
                $pkg,
                $description,
                $this->renderCopyrightYears(),
            ],
            $header
        );

        $rules['header'] = \trim($header);

        return $rules;
    }

    private function renderCopyrightYears(): string
    {
        $now = date('Y');
        $year = $this->yr ?? self::BIRTH_YEAR;

        return ($now !== $year) ? $year . ' - ' . $now : $year;
    }
}

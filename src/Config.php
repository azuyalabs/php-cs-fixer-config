<?php

declare(strict_types = 1);

/**
 * This file is part of the 'php-cs-fixer-config' package.
 *
 * PHP CS Fixer config for AzuyaLabs projects.
 *
 * Copyright (c) 2024 - 2025 AzuyaLabs
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

    private bool $useHeaderComment = true;

    public function __construct(
        private ?string $yr = null,
        private ?string $org = null,
        private ?string $pkg = null,
    ) {
        parent::__construct(self::ORG);

        $this->setRiskyAllowed(true);
        $this->setDefaultRules();
    }

    public function setDefaultRules(): void
    {
        $rules = [
            // sets
            '@PER-CS' => true,
            '@Symfony' => true,

            // spaces
            'declare_equal_normalize' => ['space' => 'single'],
            'types_spaces' => [
                'space' => 'single',
            ],
            'concat_space' => ['spacing' => 'one'],
            'not_operator_with_successor_space' => true,

            // risky
            'array_indentation' => true,
            'declare_strict_types' => true,
            'dir_constant' => true,
            'get_class_to_class_keyword' => true,
            'is_null' => true,
            'modernize_strpos' => true,
            'modernize_types_casting' => true,
            'self_accessor' => true,

            // phpdoc
            'phpdoc_summary' => false,

            // phpunit
            'php_unit_method_casing' => ['case' => 'snake_case'],

            // other
            'combine_consecutive_issets' => true,
            'combine_consecutive_unsets' => true,
            'explicit_string_variable' => true,
            'no_superfluous_elseif' => true,
            'no_superfluous_phpdoc_tags' => ['remove_inheritdoc' => true],
            'ordered_class_elements' => true,
            'header_comment' => [
                'header' => 'Made with love.',
                'comment_type' => 'PHPDoc',
            ],
        ];

        if ($this->useHeaderComment) {
            $rules['header_comment'] = $this->headerComment($rules['header_comment']);
        } else {
            unset($rules['header_comment']);
        }

        $this->setRules($rules);
    }

    public function skipHeaderComment(): void
    {
        $this->useHeaderComment = false;
        $this->setDefaultRules();
    }

    /**
     * @param array<string> $rules
     *
     * @return array<string>
     */
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

        $cmp_ct = \file_get_contents(self::COMPOSER_FILENAME);
        if (false === $cmp_ct) {
            throw new \RuntimeException('unable to read composer.json contents');
        }

        $cmp = \json_decode($cmp_ct);

        $description = $cmp->description ?? self::UNKNOWN_VALUE;
        [$org, $pkg] = explode('/', $cmp->name);

        if (null !== $this->pkg && '' !== $this->pkg && '0' !== $this->pkg) {
            $pkg = $this->pkg;
        }

        if (null === $this->org || '' === $this->org) {
            $org = $org === strtolower(self::ORG) ? self::ORG : $org;
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

        return $now !== $year ? $year . ' - ' . $now : $year;
    }
}

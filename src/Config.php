<?php

declare(strict_types=1);

/**
 * This file is part of the 'azuyalabs/php-cs-fixer-config' package.
 * A PHP CS Fixer config for AzuyaLabs projects.
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

    private const COMPOSER_FILENAME = 'composer.json';

    private const UNKNOWN_VALUE = 'unknown';

    public function __construct(private string $inceptionYear = '2015')
    {
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
          'header_comment' => [
              'comment_type' => 'PHPDoc',
          ],

          // risky
          'declare_strict_types' => true,
          'dir_constant' => true,
          'get_class_to_class_keyword' => true,
          'is_null' => true,
          'modernize_strpos' => true,
          'modernize_types_casting' => true,
          'self_accessor' => true,
        ];

        $rules['header_comment'] = $this->headerComment($rules['header_comment']);

        return $rules;
    }

    private function headerComment(array $rules): array
    {
        $header = <<<'HDR'
        This file is part of the '%package%' package.
        A %description%.

        Copyright (c) %years% %org%

        For the full copyright and license information, please view the LICENSE
        file that was distributed with this source code.

        @author Sacha Telgenhof <me at sachatelgenhof dot com>
        HDR;

        $cmp = null;
        if (\is_readable(self::COMPOSER_FILENAME)) {
            $cmp = \json_decode(\file_get_contents(self::COMPOSER_FILENAME));
            $package = $cmp->name;
            $description = $cmp->description;
        }

        $header = \str_replace(
            [
                '%org%',
                '%package%',
                '%description%',
                '%years%',
            ],
            [
                self::ORG,
                $cmp->name ?? self::UNKNOWN_VALUE,
                $cmp->description ?? self::UNKNOWN_VALUE,
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
        if ($now !== $this->inceptionYear) {
            return $this->inceptionYear.' - '.$now;
        }

        return $this->inceptionYear;
    }
}

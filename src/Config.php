<?php

declare(strict_types=1);

/**
 * This file is part of the azuyalabs/php-cs-fixer-config package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
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

    private const HEADER_FILENAME = '.header';

    private const COMPOSER_FILENAME = 'composer.json';

    public function __construct()
    {
        parent::__construct(self::ORG);

        $this->setRiskyAllowed(true);
    }

    public function getRules(): array
    {
        $rules = [
          '@PER' => true,
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
        $header = self::ORG;
        $hdr_file = dirname(__DIR__).DIRECTORY_SEPARATOR.self::HEADER_FILENAME;
        if (\is_readable($hdr_file)) {
            $header = \file_get_contents($hdr_file);
        }

        $header = \str_replace(['/**', '/*', ' */', ' * ', ' *'], '', $header);

        $package = 'unknown';
        if (\is_readable(self::COMPOSER_FILENAME)) {
            $package = \json_decode(\file_get_contents(self::COMPOSER_FILENAME))->name;
        }

        $header = \str_replace(
            ['%org%', '%package%', '%year%'],
            [self::ORG, $package, (new \DateTime('now'))->format('Y')],
            $header
        );

        $rules['header'] = \trim($header);

        return $rules;
    }
}

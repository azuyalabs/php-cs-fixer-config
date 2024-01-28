<?php

/**
 * Prooph was here at `azuyalabs/php-cs-fixer-config` in `2024`! Please create a .docheader in the project root and run `composer cs-fix`
 */

declare(strict_types=1);

namespace AzuyaLabs\PhpCsFixerConfig;

use PhpCsFixer\Config as PhpCsFixerConfig;

class Config extends PhpCsFixerConfig
{
    public function __construct()
    {
        parent::__construct('AzuyaLabs');

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
  'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => true ],
  'ordered_class_elements' => true,

  // Risky
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
        if (\file_exists('.docheader')) {
            $header = \file_get_contents('.docheader');
        } else {
            $header = $rules['header'];
        }

        // remove comments from existing .docheader or crash
        $header = \str_replace(['/**', ' */', ' * ', ' *'], '', $header);
        $package = 'unknown';

        if (\file_exists('composer.json')) {
            $package = \json_decode(\file_get_contents('composer.json'))->name;
        }

        $header = \str_replace(['%package%', '%year%'], [$package, (new \DateTime('now'))->format('Y')], $header);

        $rules['header'] = \trim($header);

        return $rules;
    }
}

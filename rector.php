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

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // single rules
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // sets of rules
    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::PHP_83,
        SetList::TYPE_DECLARATION,
    ]);
};

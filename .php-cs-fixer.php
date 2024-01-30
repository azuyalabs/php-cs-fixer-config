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

$config = new AzuyaLabs\PhpCsFixerConfig\Config('2024');
$config->getFinder()->in(__DIR__);

return $config;

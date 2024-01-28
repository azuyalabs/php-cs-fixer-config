<?php

/**
 * This file is part of `prooph/php-cs-fixer-config`.
 * (c) 2016-2020 prooph software GmbH <contact@prooph.de>
 * (c) 2016-2020 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

$config = new AzuyaLabs\PhpCsFixerConfig\Config();
$config->getFinder()->in(__DIR__);

return $config;

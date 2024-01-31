<?php

declare(strict_types = 1);

/**
 * This file is part of the 'azuyalabs/php-cs-fixer-config' package.
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

namespace AzuyaLabs\PhpCsFixerConfig\Test;

use AzuyaLabs\PhpCsFixerConfig\Config;
use PhpCsFixer\ConfigInterface;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    /**
     * @test
     */
    public function it_implements_interface(): void
    {
        $config = new Config();
        $this->assertInstanceOf(ConfigInterface::class, $config);
    }

    /**
     * @test
     */
    public function it_returns_correct_values(): void
    {
        $config = new Config();
        $this->assertSame('AzuyaLabs', $config->getName());
        $this->assertTrue($config->getUsingCache());
        $this->assertTrue($config->getRiskyAllowed());
    }

    /**
     * @test
     */
    public function it_has_rules(): void
    {
        $config = new Config();
        $this->assertNotEmpty($config->getRules());
    }

    /**
     * @test
     */
    public function it_does_have_header_comment_fixer_by_default(): void
    {
        $config = new Config();
        $rules = $config->getRules();
        $this->assertArrayHasKey('header_comment', $rules);
    }
}

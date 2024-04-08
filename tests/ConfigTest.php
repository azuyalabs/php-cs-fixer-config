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

namespace AzuyaLabs\PhpCsFixerConfig\Test;

use AzuyaLabs\PhpCsFixerConfig\Config;
use PhpCsFixer\ConfigInterface;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    /** @test */
    public function it_implements_interface(): void
    {
        $config = new Config();
        $this->assertInstanceOf(ConfigInterface::class, $config);
    }

    /** @test */
    public function it_returns_correct_values(): void
    {
        $config = new Config();
        $this->assertSame('AzuyaLabs', $config->getName());
        $this->assertTrue($config->getUsingCache());
        $this->assertTrue($config->getRiskyAllowed());
    }

    /** @test */
    public function it_can_replace_all_rules(): void
    {
        $config = new Config();

        $rules = [
            'new_rule' => true,
            'another_rule' => [
                'foo' => 'bar',
                'milk' => 'man',
            ],
        ];

        $config->setRules($rules);

        $this->assertSame($rules, $config->getRules());
    }

    /** @test */
    public function it_can_override_existing_rule(): void
    {
        $config = new Config();

        $defaults = $config->getRules();

        $this->assertTrue($defaults['@PER-CS']);
        $this->assertTrue($defaults['@Symfony']);

        $config->setRules(array_merge($defaults, [
            '@Symfony' => false,
        ]));

        $rules = $config->getRules();

        $this->assertTrue($rules['@PER-CS']);
        $this->assertFalse($rules['@Symfony']);
    }

    /** @test */
    public function it_has_rules(): void
    {
        $config = new Config();
        $this->assertNotEmpty($config->getRules());
    }

    /** @test */
    public function it_has_header_comment_fixer_by_default(): void
    {
        $config = new Config();
        $rules = $config->getRules();
        $this->assertArrayHasKey('header_comment', $rules);
    }

    /** @test */
    public function it_does_not_render_header_when_skipped(): void
    {
        $config = new Config();
        $config->skipHeaderComment();

        $rules = $config->getRules();
        $this->assertArrayNotHasKey('header_comment', $rules);
    }

    /**
     * @test
     *
     * @dataProvider yearProvider
     */
    public function it_should_have_copyright_year_in_header(?string $year, string $expected): void
    {
        $config = new Config($year);
        $rules = $config->getRules();

        $this->assertStringContainsString($expected, $rules['header_comment']['header']);
    }

    public static function yearProvider(): array
    {
        $now = date('Y');

        return [
            ['2018', sprintf('2018 - %s', $now)],
            [$now, $now],
            [null, sprintf('2015 - %s', $now)],
        ];
    }

    /**
     * @test
     *
     * @dataProvider orgProvider
     */
    public function it_should_have_organization_name_in_header(?string $org, string $expected): void
    {
        $config = new Config(date('Y'), $org);
        $rules = $config->getRules();

        $this->assertStringContainsString($expected, $rules['header_comment']['header']);
    }

    public static function orgProvider(): array
    {
        $now = date('Y');
        $patt = '(c) %s %s';

        return [
            ['myOrg', sprintf($patt, $now, 'myOrg')],
            [null, sprintf($patt, $now, 'AzuyaLabs')],
            ['', sprintf($patt, $now, 'AzuyaLabs')],
        ];
    }

    /**
     * @test
     *
     * @dataProvider pkgProvider
     */
    public function it_should_have_package_name_in_header(?string $pkg, string $expected): void
    {
        $config = new Config(date('Y'), null, $pkg);
        $rules = $config->getRules();

        $this->assertStringContainsString($expected, $rules['header_comment']['header']);
    }

    public static function pkgProvider(): array
    {
        $patt = 'part of the \'%s\' package';

        return [
            ['myPackage', sprintf($patt, 'myPackage')],
            [null, sprintf($patt, 'php-cs-fixer-config')],
            ['', sprintf($patt, 'php-cs-fixer-config')],
        ];
    }
}

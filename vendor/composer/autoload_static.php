<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7c12dbe799db7aa8541d7b98add6f4f9
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Translation\\' => 30,
            'Symfony\\Component\\Filesystem\\' => 29,
            'Symfony\\Component\\EventDispatcher\\' => 34,
            'Symfony\\Component\\DependencyInjection\\' => 38,
            'Symfony\\Component\\Debug\\' => 24,
            'Symfony\\Component\\Console\\' => 26,
            'Symfony\\Component\\Config\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Container\\' => 14,
        ),
        'B' => 
        array (
            'Behat\\Transliterator\\' => 21,
            'Behat\\Testwork\\' => 15,
            'Behat\\Behat\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Symfony\\Component\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
        ),
        'Symfony\\Component\\DependencyInjection\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dependency-injection',
        ),
        'Symfony\\Component\\Debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/debug',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Symfony\\Component\\Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/config',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Behat\\Transliterator\\' => 
        array (
            0 => __DIR__ . '/..' . '/behat/transliterator/src/Behat/Transliterator',
        ),
        'Behat\\Testwork\\' => 
        array (
            0 => __DIR__ . '/..' . '/behat/behat/src/Behat/Testwork',
        ),
        'Behat\\Behat\\' => 
        array (
            0 => __DIR__ . '/..' . '/behat/behat/src/Behat/Behat',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Behat\\Gherkin' => 
            array (
                0 => __DIR__ . '/..' . '/behat/gherkin/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7c12dbe799db7aa8541d7b98add6f4f9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7c12dbe799db7aa8541d7b98add6f4f9::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7c12dbe799db7aa8541d7b98add6f4f9::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7c12dbe799db7aa8541d7b98add6f4f9::$classMap;

        }, null, ClassLoader::class);
    }
}

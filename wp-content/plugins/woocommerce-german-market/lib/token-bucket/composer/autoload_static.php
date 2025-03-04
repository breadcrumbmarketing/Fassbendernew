<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7fb2b32778d521ebba422fc2e1748b17
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
    );

    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'malkusch\\lock\\' => 14,
        ),
        'b' => 
        array (
            'bandwidthThrottle\\tokenBucket\\' => 30,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'malkusch\\lock\\' => 
        array (
            0 => __DIR__ . '/..' . '/malkusch/lock/classes',
        ),
        'bandwidthThrottle\\tokenBucket\\' => 
        array (
            0 => __DIR__ . '/..' . '/bandwidth-throttle/token-bucket/classes',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7fb2b32778d521ebba422fc2e1748b17::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7fb2b32778d521ebba422fc2e1748b17::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7fb2b32778d521ebba422fc2e1748b17::$classMap;

        }, null, ClassLoader::class);
    }
}

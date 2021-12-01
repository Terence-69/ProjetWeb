<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb27339d876c261ab4a39043de69a1051
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Meteo\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Meteo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb27339d876c261ab4a39043de69a1051::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb27339d876c261ab4a39043de69a1051::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb27339d876c261ab4a39043de69a1051::$classMap;

        }, null, ClassLoader::class);
    }
}
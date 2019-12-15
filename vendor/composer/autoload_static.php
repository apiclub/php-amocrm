<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb3cb5fb1b01084ed00e33829e7363a18
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'ApiClub\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ApiClub\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb3cb5fb1b01084ed00e33829e7363a18::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb3cb5fb1b01084ed00e33829e7363a18::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

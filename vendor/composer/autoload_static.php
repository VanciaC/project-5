<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbb124b6b19f94c96d5d215ebadcf1647
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbb124b6b19f94c96d5d215ebadcf1647::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbb124b6b19f94c96d5d215ebadcf1647::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd3e3ce50c1106fb6565265a7eb2920f6
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd3e3ce50c1106fb6565265a7eb2920f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd3e3ce50c1106fb6565265a7eb2920f6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
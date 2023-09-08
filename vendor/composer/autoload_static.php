<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit943a72018feb5b71c27131722c82b668
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit943a72018feb5b71c27131722c82b668::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit943a72018feb5b71c27131722c82b668::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit943a72018feb5b71c27131722c82b668::$classMap;

        }, null, ClassLoader::class);
    }
}

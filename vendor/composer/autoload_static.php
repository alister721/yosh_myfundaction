<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1b087f4b63ff5eea42315da8a52ababb
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
        'UltraMsg\\WhatsAppApi' => __DIR__ . '/..' . '/ultramsg/whatsapp-php-sdk/ultramsg.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1b087f4b63ff5eea42315da8a52ababb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1b087f4b63ff5eea42315da8a52ababb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1b087f4b63ff5eea42315da8a52ababb::$classMap;

        }, null, ClassLoader::class);
    }
}

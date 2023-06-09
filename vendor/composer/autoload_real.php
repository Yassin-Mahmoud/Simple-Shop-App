<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitac042ad63dd4f0f7ffadde2b128d96ae
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitac042ad63dd4f0f7ffadde2b128d96ae', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitac042ad63dd4f0f7ffadde2b128d96ae', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitac042ad63dd4f0f7ffadde2b128d96ae::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}

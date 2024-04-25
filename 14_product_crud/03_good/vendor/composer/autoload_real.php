<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit41505b21c0eedd8779c9a1b3304ad4bb
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

        spl_autoload_register(array('ComposerAutoloaderInit41505b21c0eedd8779c9a1b3304ad4bb', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit41505b21c0eedd8779c9a1b3304ad4bb', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit41505b21c0eedd8779c9a1b3304ad4bb::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}

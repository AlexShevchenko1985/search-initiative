<?php

namespace App\Base;

/**
 * Abstract Singleton class. Use for inheritance
 * @package App\Base
 */
abstract class Singleton
{

    /** @var array $instances */
    protected static array $instances = [];

    /**
     * Instance getter
     * @return Singleton Instance
     */
    public static function getInstance(): Singleton
    {
        if (empty(self::$instances[static::class])) {
            $instance = new static();

            self::$instances[static::class] = $instance;
        } else {
            $instance = self::$instances[static::class];
        }

        return $instance;
    }

    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup() {}

}

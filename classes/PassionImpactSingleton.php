<?php

namespace PassionImpact;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class PassionImpactSingleton
 * @package PassionImpact
 */
class PassionImpactSingleton
{
    private static $instance = [];

    protected function __construct() {}

    /**
     * @return mixed|null
     */
    public static function getInstance(): mixed
    {
        $class = get_called_class();

        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new $class;
        }

        return self::$instance[$class];
    }
}

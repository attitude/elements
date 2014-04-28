<?php

/**
 * Dependency Container
 */

namespace attitude\Elements;

/**
 * Dependency Container Class
 *
 * Really basic and flat implementation of dependency container (no deep
 * loading of dependencies).
 *
 * @author Martin Adamko <@martin_adamko>
 * @version v0.1.1
 * @licence MIT
 *
 * @changes v0.1.1  Add option to pass default value to setter method
 * @changes v0.1.0  Initial version
 *
 */
class DependencyContainer
{
    /**
     * Pool of dependencies
     *
     * @var array
     */
    public static $dependencies = array();

    /**
     * Constant meaning `is required`
     *
     * @var string
     */
    const REQUIRED = '__IS_REQUIRED__';

    /**
     * Class Constructor
     *
     * Private since no instances should be created.
     *
     * @param void
     * @returns void
     *
     */
    private function __construct() {}

    /**
     * Dependency Setter
     *
     * @param   string  $key    Expected class
     * @param   string  $dependency  Explicitly defined class name or object
     *
     */
    public static function set($key, $dependency=null)
    {
        if (!is_string($key) || empty($key)) {
            trigger_error('DI: A `$key` must be a valid string. Die.', E_USER_ERROR);
        }

        self::$dependencies[$key] = $dependency;
    }

    /**
     * Dependency Getter
     *
     * @param   string  $key    Expected class
     * @returns object          Dependency object
     *
     */
    public static function get($key, $default=self::REQUIRED)
    {
        // Basic checks
        if (!is_string($key) || empty($key)) {
            trigger_error('DI: A `$key` must be a valid string. Die.', E_USER_ERROR);
        }

        if (!isset(self::$dependencies[$key])) {
            if ($default===self::REQUIRED) {
                throw new HTTPException(500, '`'.$key.'` dependency is undefined.');
            } else {
                return $default;
            }
        }

        // One instance to rule them all
        if (is_object(self::$dependencies[$key])) {
            return self::$dependencies[$key];
        }

        return self::$dependencies[$key];
    }
}

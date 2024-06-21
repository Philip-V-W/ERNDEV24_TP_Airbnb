<?php

namespace Core\Repository;

trait RepositoryManagerTrait
{
    /**
     * A trait to manage a singleton instance of a class.
     * The self keyword will refer to the class that uses this trait.
     */

    // Private property to hold the singleton instance of the class using this trait
    private static ?self $rm_instance = null;

    /**
     * Returns the singleton instance of the class using this trait.
     * @return self The singleton instance.
     */
    public static function getRm(): self
    {
        if (is_null(self::$rm_instance)) {
            self::$rm_instance = new self();
        }
        return self::$rm_instance;
    }

    // Prevent direct instantiation
    protected function __construct() {}

    // Prevent object cloning
    protected function __clone() {}

    // Public method with an exception to prevent unserializing the singleton instance
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}

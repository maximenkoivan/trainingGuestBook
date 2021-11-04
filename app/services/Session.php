<?php

namespace App\services;
/**
 * Wrapper class for working with $_SESSION.
 * - getInstance()  -This method returns an instance of the class.
 * - set()          -This method writes data to the session.
 * - get()          -This method deletes data from the session.
 * - destroy()      -This method gets data from the session.
 */
class Session
{
    /**
     * @var object|null
     */
    private static object|null $instance = null;

    /**
     * This method returns an instance of the class.
     * @return object|null
     */
    public static function getInstance(): object|null
    {
        if (!isset(self::$instance)) {
            self::$instance = new Session();
        }
        return self::$instance;
    }


    /**
     * This method writes data to the session.
     * @param string $name
     * @param array $value
     * @return void
     */
    public function set(string $name, array $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * This method gets data from the session.
     * @param string $nameArray
     * @param string $name
     * @return mixed
     */
    public function get(string $nameArray, string $name): mixed
    {
            return $_SESSION[$nameArray][$name] ?? null;
    }

    /**
     * This method deletes data from the session.
     * @param string $name
     * @return void
     */
    public function destroy(string $name)
    {
        unset($_SESSION[$name]);
    }
}
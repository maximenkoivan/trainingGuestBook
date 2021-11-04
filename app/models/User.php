<?php

namespace App\models;

use donatj\UserAgent\UserAgentParser;
use App\services\Database;

/**
 * User model class.
 *
 * - getUserIp()        -This method allows you to get the user's ip.
 * - getUserId()        -This method allows you to get the user ID by e-mail.
 * - getBrowserInfo()   -This method allows you to get information about the user's browser.
 * - checkUniqEmail()   -This method checks the uniqueness of the email in the database.
 * - insertUser()       -Writes the user to the database.
 * - updateUser()       -Updates the username in the database.
 * - updateUser()       -Updates the username in the database.
 */
class User
{
    /**
     * This method allows you to get the user's ip.
     * @return string|null
     */
    public static function getUserIp(): null|string
    {
        $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR'
        ];
        foreach ($keys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = explode(',', $_SERVER[$key]);
                $ip = trim(end($ip));
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
        return null;
    }

    /**
     * This method allows you to get the user ID by e-mail.
     * @param array $email
     * @return array
     */
    public static function getUserId(array $email): array
    {
        $key = key($email);

        return  Database::getInstance()->query("SELECT user_id FROM users WHERE {$key} =:{$key}", $email)->getResult()[0];

    }

    /**
     * This method allows you to get information about the user's browser.
     * @return string
     */
    public static function getBrowserInfo(): string
    {
        $userAgent = new UserAgentParser();
        return $userAgent->parse()->browser() . ' ' . $userAgent->parse()->browserVersion();
    }

    /**
     * This method checks the uniqueness of the email in the database.
     * @param array $email
     * @return bool
     */
    public static function checkUniqEmail(array $email): bool
    {
        $key = key($email);
        if (!empty(Database::getInstance()->query("SELECT 1 FROM users WHERE {$key} = :{$key}", $email)->getResult())) {
            return true;
        } else {
            return false;
            }
        }

    /**
     * Writes the user to the database.
     * @param array $user
     */
    public static function insertUser(array $user): void
    {
        $columns = implode(', ', array_keys($user));
        $value = ':' . implode(', :', array_keys($user));
        Database::getInstance()->query("INSERT INTO users ({$columns}) VALUE ({$value})", $user);
    }

    /**
     * Updates the username in the database.
     * @param array $data
     */
    public static function updateUser(array $data): void
    {
        Database::getInstance()->query("UPDATE users SET username = :username WHERE user_id = :user_id", $data);
    }
}
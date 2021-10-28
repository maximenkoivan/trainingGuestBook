<?php


namespace App\services;


class Helper
{

    public static function getIp()
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
    }

    public static function redirectTo($path, $data = null)
    {
        if ($data) {
        $_SESSION['data'] = $data;
        }
        header('Location: ' . $path);
    }
}
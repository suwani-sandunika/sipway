<?php

class MySQL
{
    private static mysqli $connection;
    private static string $host = '127.0.0.1';
    private static string $username = 'root';
    private static string $password = 'password';
    private static string $database = 'sipway';
    private static string $port = '3306';

    private static function set_up_connection(): void
    {
        if (!isset(self::$connection)) {
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$database, self::$port);
        }
    }

    public static function iud($query): void
    {
        self::set_up_connection();
        self::$connection->query($query);
    }

    public static function search($query): mysqli_result|bool
    {
        MySQL::set_up_connection();
        return self::$connection->query($query);
    }
}
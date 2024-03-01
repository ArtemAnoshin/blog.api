<?php

namespace Artem\Blogapi\Db;

use PDO;

// Singletone
class DB
{
    private static $instance;

    private static $db;

    private function __construct()

    {
        $host = "mysql";
        $dbname = "blog.api";
        $username = "root";
        $password = "secret";

        self::$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public static function query($query)
    {
        return self::$db->query($query);
    }

    public static function prepare(string $query, $params = [])
    {
        return self::$db->prepare($query, $params);
    }
}
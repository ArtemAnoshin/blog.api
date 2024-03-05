<?php

namespace Artem\Blogapi\Repository;

use Artem\Blogapi\Db\Db;
use PDO;

class UserRepository
{
    public static function isUserExists(string $name, string $password): bool|array
    {
        $db = Db::getInstance();

        $sql = "SELECT 1 FROM user WHERE name = :name AND password = :password";
        $query = $db::prepare($sql);
        $query->execute([
            'name' => $name,
            'password' => $password,
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

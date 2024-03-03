<?php

namespace Artem\Blogapi\Repository;

use Artem\Blogapi\Db\Db;
use PDO;

class ArticleRepository
{
    public static function getById(int $id): array|bool
    {
        $db = Db::getInstance();

        $sql = "SELECT id, author_name, body FROM article WHERE id = :id";
        $query = $db::prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function articleExistsById(int $id): array|bool
    {
        $db = Db::getInstance();

        $sql = "SELECT id FROM article WHERE id = :id";
        $query = $db::prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

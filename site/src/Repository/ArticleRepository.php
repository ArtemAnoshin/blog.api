<?php

namespace Artem\Blogapi\Repository;

use Artem\Blogapi\Db\Db;
use Artem\Blogapi\Entity\Article;
use PDO;

class ArticleRepository
{
    public static function getById(int $id): Article|null
    {
        $db = Db::getInstance();

        $sql = "SELECT * FROM article WHERE id = :id";
        $query = $db::prepare($sql);
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if (is_array($result) && !empty($result)) {
            return (new Article())
                ->setId($id)
                ->setAuthorName($result['author_name'])
                ->setBody($result['body']);
        }

        return null;
    }
}
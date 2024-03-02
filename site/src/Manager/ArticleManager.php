<?php

namespace Artem\Blogapi\Manager;

use Artem\Blogapi\Entity\Article;
use Artem\Blogapi\Db\Db;

class ArticleManager
{
    public function create(Article $article): int
    {
        $db = Db::getInstance();

        $sql = "INSERT INTO article (author_name, body) VALUES (:author_name, :body);";
        $query = $db::prepare($sql);
        $query->execute([
            'author_name' => $article->getAuthorName(),
            'body' => $article->getBody(),
        ]);

        return $db::lastInsertId();
    }
}

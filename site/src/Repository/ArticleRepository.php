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

    public static function getArticles(int $count = 5, int $page = 1): false|array
    {
        $db = Db::getInstance();

        $offset = ($page - 1) * $count;

        $sql = "
            SELECT 
                article.id as article_id,
                article.author_name as author_name,
                article.body as article_text,
                comment.id as comment_id,
                comment.comment_author as comment_author,
                comment.body as comment_text
            FROM article
            LEFT JOIN comment
            ON article.id=comment.article_id

            WHERE comment.id IN (
            SELECT t.id FROM (
                    SELECT 
                        comment.id
                    FROM comment
                    WHERE comment.article_id = article.id
                    ORDER BY comment.id DESC
                LIMIT 3
                ) as t
            )

            ORDER BY article.id ASC
            LIMIT $count
            OFFSET $offset
        ";
        $query = $db::prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

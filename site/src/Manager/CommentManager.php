<?php

namespace Artem\Blogapi\Manager;

use Artem\Blogapi\Db\Db;
use Artem\Blogapi\Entity\Comment;
use Artem\Blogapi\Repository\ArticleRepository;
use Exception;
use InvalidArgumentException;

class CommentManager
{
    public function create(Comment $comment): int
    {
        $db = Db::getInstance();

        if (!ArticleRepository::articleExistsById($comment->getArticleId())) {
            throw new InvalidArgumentException('Article is not found', 422); 
        }

        $sql = "INSERT INTO comment (comment_author, body, article_id, created_at) VALUES (:comment_author, :body, :article_id, :created_at);";
        $query = $db::prepare($sql);

        try {
            $query->execute([
                'comment_author' => $comment->getCommentAuthor(),
                'body' => $comment->getBody(),
                'article_id' => $comment->getArticleId(),
                'created_at' => $comment->getCreatedAt(),
            ]);

            return $db::lastInsertId();
        } catch (Exception $ex) {
               throw new InvalidArgumentException($ex->getMessage(), 422);
        }
    }
}
